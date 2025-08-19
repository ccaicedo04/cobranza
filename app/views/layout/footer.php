</main>
<script src="<?php echo View::asset('js/app.js'); ?>"></script>
<script src="<?php echo View::asset('js/ui.js'); ?>"></script>
<script src="<?php echo View::asset('js/fetcher.js'); ?>"></script>
<script src="<?php echo View::asset('js/forms.js'); ?>"></script>
<?php if (!empty($scripts)):
foreach ($scripts as $s): ?>
<script src="<?php echo View::asset($s); ?>"></script>
<?php endforeach; endif; ?>
