<?php if (defined('ICL_LANGUAGE_CODE')): ?>

    <?php $langs = my_languages(); ?>

    <div class="dropdown dropdown-lang">
        <a href="javascript:" class="dropdown-toggle" id="dropdownMenuLang" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="icon icon-flag-<?php echo strtolower(ICL_LANGUAGE_CODE); ?>"></i>
            <span><?php echo esc_html(strtoupper(ICL_LANGUAGE_CODE)); ?></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLang">
            <?php foreach ($langs as $key => $value): ?>
                <?php if ($key !== ICL_LANGUAGE_CODE): ?>
                    <a class="dropdown-item" href="<?php echo $value['url']; ?>">
                        <i class="icon icon-flag-<?php echo $key; ?>"></i>
                        <span><?php echo $value['nombre']; ?></span>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

<?php endif; ?>
