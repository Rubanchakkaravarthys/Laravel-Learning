<h3>Dynamic </h3>
<!-- <a href="<?= url('page/1/page') ?>">First Page</a>
<a href="<?= url('page/1/number') ?>">Number Page</a>
<a href="<?= url('page/1 ') ?>">Page</a> -->


<a href="<?=route('dynamic-page',['id'=>1,'type' => 'page'])?>">First Page</a>
<a href="<?=route('dynamic-page',['id'=>1,'type' => 'number'])?>">Number Page</a>
<a href="<?=route('dynamic-page',['id'=>1])?>">Page</a>
