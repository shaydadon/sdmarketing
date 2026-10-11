<?php
// Device frame (laptop for sites, phone for PWAs) whose screen scrolls through the project on hover / when in view.
function device_frame(array $p, string $extra = ''): void
{
    $shot = project_screenshot($p['slug']);
    $isPhone = $p['device'] === 'phone';
    ?>
    <div class="device device--<?= $isPhone ? 'phone' : 'laptop' ?> <?= $extra ?>" data-device aria-hidden="true">
      <div class="device-frame">
        <?php if ($isPhone): ?>
          <span class="device-notch"></span>
        <?php else: ?>
          <div class="device-bar"><i></i><i></i><i></i><span dir="ltr"><?= e($p['url'] ? preg_replace('#^https?://#', '', $p['url']) : strtolower($p['name'])) ?></span></div>
        <?php endif; ?>
        <div class="device-screen">
          <div class="screen-content" data-screen>
            <?php if ($shot): ?>
              <img src="<?= e($shot) ?>" alt="" loading="lazy">
            <?php elseif ($p['screen'] === 'shop'): ?>
              <?php mock_fisha(); ?>
            <?php else: ?>
              <?php mock_app($p['name'], $p['slug'] === 'boardog' ? 'dark' : 'blue'); ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php if (!$isPhone): ?><div class="device-base"></div><?php endif; ?>
    </div>
    <?php
}

// Drawn stand-in for fisha.shop until a real capture is added.
function mock_fisha(): void
{ ?>
  <div class="mk-fisha" dir="ltr">
    <div class="mkf-nav"><b>fisha</b><span>Home</span><span>Shop</span><span>Our Story</span><span>About</span><span>Contact</span></div>
    <div class="mkf-hero">
      <small>fisha</small>
      <h4>A little <em>light</em>, in every form</h4>
      <svg viewBox="0 0 320 120" class="mkf-sketch">
        <path d="M40 100 Q 70 40 95 98 M90 100 Q 120 55 150 100 M140 100 Q 175 70 205 100 M200 100 Q 225 60 250 100 M245 100 Q 268 80 285 100" />
        <path d="M60 60 q 30 -12 60 -2 q -30 10 -60 2 z M150 45 q 34 -14 66 -2 q -34 12 -66 2 z" />
        <path d="M110 100 v -55 M118 100 v -70 M250 100 v -60 M258 100 v -45" />
        <path d="M20 108 H 300" />
      </svg>
    </div>
    <div class="mkf-story"><h5>Our Story</h5><p></p><p></p><p class="short"></p></div>
    <div class="mkf-cats">
      <div><i></i><b>Wearables</b><span>Shop Wearables</span></div>
      <div><i></i><b>Collectibles</b><span>Shop Collectibles</span></div>
      <div><i></i><b>Originals</b><span>Shop Originals</span></div>
    </div>
    <div class="mkf-grid"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></div>
    <div class="mkf-foot"><b>fisha</b><span></span><span></span></div>
  </div>
<?php }

// Drawn stand-in for a PWA until a real capture is added.
function mock_app(string $name, string $tone): void
{ ?>
  <div class="mk-app mk-app--<?= $tone ?>" dir="ltr">
    <div class="mka-top"><b><?= e(mb_substr($name, 0, 1)) ?></b><span><?= e($name) ?></span><i></i></div>
    <div class="mka-hero"><span></span><span class="short"></span><em></em></div>
    <div class="mka-row"><i></i><i></i><i></i></div>
    <div class="mka-list">
      <?php for ($i = 0; $i < 12; $i++): ?><div><i></i><span><b></b><b class="short"></b></span></div><?php endfor; ?>
    </div>
    <div class="mka-card"><span></span><span class="short"></span></div>
    <div class="mka-tabs"><i class="on"></i><i></i><i></i><i></i></div>
  </div>
<?php }
