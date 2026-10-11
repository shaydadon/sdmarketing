(() => {
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- Header: scrolled state ---------- */
  const header = document.querySelector('[data-header]');
  const onScroll = () => header && header.classList.toggle('is-scrolled', window.scrollY > 8);
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });

  /* ---------- Mobile nav ---------- */
  const toggle = document.querySelector('[data-nav-toggle]');
  const mobileNav = document.querySelector('[data-mobile-nav]');
  if (toggle && mobileNav) {
    const setOpen = (open) => {
      toggle.setAttribute('aria-expanded', String(open));
      mobileNav.hidden = !open;
    };
    toggle.addEventListener('click', () => {
      const open = toggle.getAttribute('aria-expanded') !== 'true';
      setOpen(open);
      if (open) mobileNav.querySelector('a').focus();
    });
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
        setOpen(false);
        toggle.focus();
      }
    });
    window.matchMedia('(min-width: 961px)').addEventListener('change', (e) => e.matches && setOpen(false));
  }

  /* ---------- Hero demo: chat plays, then the automations fire ---------- */
  const demo = document.querySelector('[data-demo]');
  if (demo && !reduceMotion) {
    const steps = [...demo.querySelectorAll('[data-step]')].sort((a, b) => a.dataset.step - b.dataset.step);
    const typing = demo.querySelector('[data-typing]');
    const status = demo.querySelector('[data-status]');
    const chat = demo.querySelector('[data-chat]');
    const wait = (ms) => new Promise((r) => setTimeout(r, ms));
    let visible = true;

    new IntersectionObserver(([entry]) => { visible = entry.isIntersecting; }).observe(demo);

    const showTyping = async (ms) => {
      chat.appendChild(typing); // keep the indicator after the last message
      typing.classList.add('is-on');
      if (status) status.textContent = 'מקליד/ה...';
      await wait(ms);
      typing.classList.remove('is-on');
      if (status) status.textContent = 'מחובר/ת';
    };

    const play = async () => {
      demo.classList.add('is-playing');
      while (true) {
        steps.forEach((s) => s.classList.remove('is-on', 'is-fresh'));
        await wait(700);
        for (const step of steps) {
          while (!visible) await wait(400);
          const isBot = step.classList.contains('out');
          const isFlow = step.classList.contains('flow-node');
          if (isBot) await showTyping(1100);
          step.classList.add('is-on');
          if (isFlow) {
            step.classList.add('is-fresh');
            setTimeout(() => step.classList.remove('is-fresh'), 1200);
          }
          await wait(isFlow ? 650 : 1100);
        }
        await wait(5000);
      }
    };
    play();
  }

  /* ---------- Services tabs ---------- */
  document.querySelectorAll('[data-tabs]').forEach((root) => {
    const tabs = [...root.querySelectorAll('[role="tab"]')];
    const select = (tab, focus) => {
      tabs.forEach((t) => {
        const on = t === tab;
        t.setAttribute('aria-selected', String(on));
        t.tabIndex = on ? 0 : -1;
        document.getElementById(t.getAttribute('aria-controls')).hidden = !on;
      });
      if (focus) tab.focus();
    };
    tabs.forEach((tab, i) => {
      tab.addEventListener('click', () => select(tab));
      tab.addEventListener('keydown', (e) => {
        const next = { ArrowDown: 1, ArrowLeft: 1, ArrowUp: -1, ArrowRight: -1 }[e.key];
        if (next) { e.preventDefault(); select(tabs[(i + next + tabs.length) % tabs.length], true); }
        if (e.key === 'Home') { e.preventDefault(); select(tabs[0], true); }
        if (e.key === 'End') { e.preventDefault(); select(tabs[tabs.length - 1], true); }
      });
    });
  });

  /* ---------- Services page: highlight the section in view ---------- */
  const jump = document.querySelector('[data-jump]');
  if (jump) {
    const links = [...jump.querySelectorAll('[data-jump-link]')];
    const setActive = (id) => links.forEach((l) => {
      const on = l.dataset.jumpLink === id;
      l.classList.toggle('is-active', on);
      if (on) {
        l.setAttribute('aria-current', 'true');
        l.scrollIntoView({ block: 'nearest', inline: 'nearest' });
      } else {
        l.removeAttribute('aria-current');
      }
    });
    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry) => { if (entry.isIntersecting) setActive(entry.target.id); });
    }, { rootMargin: '-45% 0px -50% 0px' });
    document.querySelectorAll('[data-jump-section]').forEach((s) => io.observe(s));
  }

  /* ---------- Projects: device screens scroll through the project ---------- */
  const devices = [...document.querySelectorAll('[data-device]')];
  if (devices.length) {
    const measure = () => devices.forEach((d) => {
      const screen = d.querySelector('.device-screen');
      const content = d.querySelector('[data-screen]');
      const distance = Math.max(0, content.scrollHeight - screen.clientHeight);
      d.style.setProperty('--scroll-y', `-${distance}px`);
      d.style.setProperty('--scroll-dur', `${Math.max(2.5, distance / 260).toFixed(2)}s`);
    });
    measure();
    window.addEventListener('load', measure);
    window.addEventListener('resize', measure);
    devices.forEach((d) => d.querySelectorAll('img').forEach((img) => img.addEventListener('load', measure)));

    // Touch screens have no hover: pan automatically while the device is on screen.
    if (!reduceMotion && window.matchMedia('(hover: none)').matches) {
      const auto = new IntersectionObserver((entries) => {
        entries.forEach((entry) => entry.target.classList.toggle('is-auto', entry.isIntersecting));
      }, { threshold: 0.6 });
      devices.forEach((d) => auto.observe(d));
    }
  }

  /* ---------- Projects: filters ---------- */
  const filters = document.querySelector('[data-filters]');
  if (filters) {
    const buttons = [...filters.querySelectorAll('[data-filter]')];
    const cases = [...document.querySelectorAll('[data-showcase] [data-cat]')];
    buttons.forEach((btn) => btn.addEventListener('click', () => {
      const cat = btn.dataset.filter;
      buttons.forEach((b) => b.setAttribute('aria-pressed', String(b === btn)));
      cases.forEach((c) => {
        const show = cat === 'all' || c.dataset.cat === cat || c.dataset.cat === 'all';
        c.hidden = !show;
        c.classList.remove('reveal');
        c.classList.toggle('is-entering', show && !reduceMotion);
      });
      document.querySelectorAll('[data-group]').forEach((g) => {
        g.hidden = ![...g.querySelectorAll('[data-cat]')].some((c) => !c.hidden);
      });
      requestAnimationFrame(() => devices.length && window.dispatchEvent(new Event('resize')));
    }));
  }

  /* ---------- Contact form: inline validation (server validates too) ---------- */
  const form = document.querySelector('[data-contact-form]');
  if (form) {
    const rules = {
      name: (v) => (v.trim().length >= 2 ? '' : 'כתבו את השם שלכם.'),
      phone: (v) => { const d = v.replace(/\D/g, ''); return d.length >= 9 && d.length <= 13 ? '' : 'מספר הטלפון לא נראה תקין. לדוגמה: 050-1234567'; },
      email: (v) => (!v.trim() || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.trim()) ? '' : 'כתובת המייל לא נראית תקינה.'),
      consent: (_, el) => (el.checked ? '' : 'כדי שנוכל לחזור אליכם יש לאשר את מדיניות הפרטיות.'),
    };
    const showError = (el, msg) => {
      const id = `err-${el.name}`;
      let err = document.getElementById(id);
      if (msg) {
        if (!err) {
          err = document.createElement('p');
          err.className = 'field-error';
          err.id = id;
          el.closest('.field').appendChild(err);
        }
        err.textContent = msg;
        el.setAttribute('aria-invalid', 'true');
        el.setAttribute('aria-describedby', id);
      } else {
        if (err) err.remove();
        el.removeAttribute('aria-invalid');
        el.removeAttribute('aria-describedby');
      }
    };
    const check = (el) => { const msg = rules[el.name](el.value, el); showError(el, msg); return !msg; };

    Object.keys(rules).forEach((name) => {
      const el = form.elements[name];
      el.addEventListener('blur', () => { if (el.value || el.type === 'checkbox') check(el); });
      el.addEventListener(el.type === 'checkbox' ? 'change' : 'input', () => { if (el.getAttribute('aria-invalid')) check(el); });
    });

    form.addEventListener('submit', (e) => {
      const invalid = Object.keys(rules).map((n) => form.elements[n]).filter((el) => !check(el));
      if (invalid.length) {
        e.preventDefault();
        invalid[0].focus();
        return;
      }
      form.querySelector('[data-submit]').classList.add('is-loading');
    });

    const alertBox = document.querySelector('[data-form-alert]');
    if (alertBox) alertBox.focus();
  }
  const sentCard = document.getElementById('sent');
  if (sentCard) sentCard.focus();

  /* ---------- Legal pages: highlight the section in view ---------- */
  const tocLinks = [...document.querySelectorAll('[data-toc-link]')];
  if (tocLinks.length) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        tocLinks.forEach((l) => l.classList.toggle('is-active', l.dataset.tocLink === entry.target.id));
      });
    }, { rootMargin: '-20% 0px -70% 0px' });
    document.querySelectorAll('[data-toc-section]').forEach((s) => io.observe(s));
  }

  /* ---------- Reveal sections on scroll ---------- */
  if (!reduceMotion && 'IntersectionObserver' in window) {
    const targets = document.querySelectorAll('.section-head, .svc, .step, .proj, .about-photo, .about-copy, .cta-inner, .svc-block-main, .svc-block-side, .journey-step, .case, .compare-side, .principle-list li, .work-item, .story-copy, .creds');
    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) { entry.target.classList.add('is-in'); io.unobserve(entry.target); }
      });
    }, { rootMargin: '0px 0px -10% 0px' });
    targets.forEach((el, i) => {
      if (el.getBoundingClientRect().top > window.innerHeight) {
        el.classList.add('reveal');
        if (el.matches('.step, .proj, .journey-step')) el.style.transitionDelay = `${(i % 4) * 80}ms`;
        io.observe(el);
      }
    });
  }

  /* ---------- Floating WhatsApp: hide while the hero is in view ---------- */
  const float = document.querySelector('.wa-float');
  const hero = document.querySelector('.hero');
  if (float && hero) {
    new IntersectionObserver(([entry]) => float.classList.toggle('is-hidden', entry.isIntersecting), { threshold: 0.25 }).observe(hero);
  }
})();
