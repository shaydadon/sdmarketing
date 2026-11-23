(() => {
  const header = document.querySelector('[data-header]');
  const onScroll = () => header && header.classList.toggle('is-scrolled', window.scrollY > 8);
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });

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
    window.matchMedia('(min-width: 801px)').addEventListener('change', (e) => e.matches && setOpen(false));
  }

  const jump = document.querySelector('[data-jump]');
  if (jump) {
    const links = [...jump.querySelectorAll('[data-jump-link]')];
    const setActive = (id) => links.forEach((l) => {
      const on = l.dataset.jumpLink === id;
      l.classList.toggle('on', on);
      if (on) l.setAttribute('aria-current', 'true');
      else l.removeAttribute('aria-current');
    });
    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry) => { if (entry.isIntersecting) setActive(entry.target.id); });
    }, { rootMargin: '-45% 0px -50% 0px' });
    document.querySelectorAll('[data-jump-section]').forEach((s) => io.observe(s));
  }

  const filters = document.querySelector('[data-filters]');
  if (filters) {
    const buttons = [...filters.querySelectorAll('[data-filter]')];
    const cases = [...document.querySelectorAll('[data-showcase] [data-cat]')];
    buttons.forEach((btn) => btn.addEventListener('click', () => {
      const cat = btn.dataset.filter;
      buttons.forEach((b) => {
        const on = b === btn;
        b.setAttribute('aria-pressed', String(on));
        b.classList.toggle('on', on);
      });
      cases.forEach((c) => { c.hidden = !(cat === 'all' || c.dataset.cat === cat); });
    }));
  }

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

  const wa = document.querySelector('[data-wa-demo]');
  if (wa) {
    const log = wa.querySelector('[data-wa-log]');
    const items = [...log.querySelectorAll('[data-msg]')];
    const typing = log.querySelector('[data-typing]');
    const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const wait = (ms) => new Promise((resolve) => setTimeout(resolve, ms));
    let scrollFrame = 0;
    const pin = () => {
      const to = log.scrollHeight;
      if (reduce) {
        log.scrollTop = to;
        return;
      }
      const from = log.scrollTop;
      const start = performance.now();
      const dur = 520;
      cancelAnimationFrame(scrollFrame);
      const step = (now) => {
        const t = Math.min(1, (now - start) / dur);
        const eased = 1 - (1 - t) ** 3;
        log.scrollTop = from + (to - from) * eased;
        if (t < 1) scrollFrame = requestAnimationFrame(step);
      };
      scrollFrame = requestAnimationFrame(step);
    };
    const typingFor = (el) => {
      const chars = (el.textContent || '').replace(/\s/g, '').length;
      const extra = Math.max(0, chars - 70);
      return Math.round(Math.min(2000, 1200 + extra * 12));
    };
    const showAll = () => {
      items.forEach((el) => { el.hidden = false; });
      if (typing) typing.hidden = true;
      pin();
    };
    const video = wa.closest('#case-bot')?.querySelector('.wad-video');
    if (video) {
      video.addEventListener('error', () => {
        video.hidden = true;
        wa.style.display = 'flex';
        showAll();
      });
    }
    if (reduce) {
      showAll();
    } else if (!video) {
      const reset = () => {
        if (typing) typing.hidden = true;
        items.forEach((el) => {
          el.hidden = true;
          el.classList.remove('wad-enter');
        });
        log.scrollTop = 0;
        delete wa.dataset.waDone;
      };
      const play = async () => {
        for (let i = 0; i < items.length; i++) {
          const el = items[i];
          const prev = items[i - 1];
          if (el.dataset.msg === 'b' && typing) {
            if (prev && prev.dataset.msg === 'c') await wait(500);
            typing.hidden = false;
            log.appendChild(typing);
            pin();
            await wait(typingFor(el));
            typing.hidden = true;
          }
          el.classList.remove('wad-enter');
          void el.offsetWidth;
          el.hidden = false;
          el.classList.add('wad-enter');
          pin();
          const next = items[i + 1];
          if (next && next.dataset.msg === 'c') await wait(90);
        }
        wa.dataset.waDone = '1';
        await wait(4000);
      };
      const loop = async () => {
        while (true) {
          reset();
          await play();
        }
      };
      loop();
    }
  }

  // Scroll reveal for elements marked .rv (home page). Skipped entirely when motion is reduced.
  const rvs = document.querySelectorAll('.rv');
  if (rvs.length && 'IntersectionObserver' in window && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    document.documentElement.classList.add('rv-on');
    const rio = new IntersectionObserver((entries) => {
      entries.forEach((en) => { if (en.isIntersecting) { en.target.classList.add('in'); rio.unobserve(en.target); } });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });
    rvs.forEach((el) => rio.observe(el));
  }

  // Count-up for numbers marked data-count, once, when they scroll into view.
  const counts = document.querySelectorAll('[data-count]');
  if (counts.length && 'IntersectionObserver' in window && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    const cio = new IntersectionObserver((entries) => {
      entries.forEach((en) => {
        if (!en.isIntersecting) return;
        cio.unobserve(en.target);
        const el = en.target; const end = +el.dataset.count; const t0 = performance.now(); const dur = 1400;
        const tick = (t) => { const k = Math.min(1, (t - t0) / dur); el.textContent = Math.round(end * (1 - Math.pow(1 - k, 3))); if (k < 1) requestAnimationFrame(tick); };
        el.textContent = '0'; requestAnimationFrame(tick);
      });
    }, { threshold: 0.6 });
    counts.forEach((el) => cio.observe(el));
  }
})();
