<?php
/** The short case study under a project: the challenge, what was built (3 points), the main button and a link to the matching service. */
function case_details(string $challenge, array $built, string $btn_html, array $service): void
{ ?>
        <dl class="cs">
          <div><dt><?= tr('האתגר', 'The challenge') ?></dt><dd><?= e($challenge) ?></dd></div>
          <div><dt><?= tr('מה בניתי', 'What I built') ?></dt><dd><ul><?php foreach ($built as $b): ?><li><?= e($b) ?></li><?php endforeach; ?></ul></dd></div>
        </dl>
        <div class="acts">
          <?= $btn_html ?>
          <a class="link" href="<?= e(lurl('services#' . $service[0])) ?>"><?= e($service[1]) ?> <?= icon('arrow') ?></a>
        </div>
<?php }
