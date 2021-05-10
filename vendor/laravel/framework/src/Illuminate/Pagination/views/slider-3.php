<?php
	$presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);
?>

<?php if ($paginator->getLastPage() > 1): ?>
	<ul class="pagination">
        <div class="paging">总数：<d><?php echo $paginator->getTotal() ?></div>
			<?php echo $presenter->render(); ?>
	</ul>
<?php endif; ?>
