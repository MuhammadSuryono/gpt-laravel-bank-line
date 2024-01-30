<!doctype html>
<html lang="en" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>GPCash</title>
<meta name="description" content="">
<?php $__env->startSection('twitter_meta'); ?>
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="" />
<meta name="_token" content="<?php echo csrf_token(); ?>"/>
<?php echo $__env->yieldSection(); ?>
<?php $__env->startSection('og'); ?>
<meta property="fb:app_id" content="<?php echo e(Config::get('facebook.appId')); ?>" />
<meta property="og:site_name" content="<?php echo e(Config::get('site.name')); ?>" />
<meta property="og:url" content="<?php echo e(URL::current()); ?>" />
<meta property="og:title" content="<?php echo $__env->yieldContent('og:title', Config::get('site.title')); ?>" />
<meta property="og:description" content="<?php echo $__env->yieldContent('description', Config::get('site.description')); ?>" />
<meta property="og:image" content="<?php echo $__env->yieldContent('og:image', Config::get('site.default_image') ); ?>" />

<?php echo $__env->yieldSection(); ?>

<style id="antiClickjack">body{display:none !important;}</style>
    <style>
        tr.row_selected td{background-color: #c2bcc3 !important;}
    </style>
<script type="text/javascript">
   if (self === top) {
       var antiClickjack = document.getElementById("antiClickjack");
       antiClickjack.parentNode.removeChild(antiClickjack);
   } else {
       top.location = self.location;
   }
</script>


<link rel="canonical" href="<?php echo e(URL::current()); ?>">
<meta name="base_url" content="<?php echo e(URL::to('/')); ?>">
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo e(assets_img('favicons/apple-icon-57x57.png')); ?>">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo e(assets_img('favicons/apple-icon-60x60.png')); ?>">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo e(assets_img('favicons/apple-icon-72x72.png')); ?>">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(assets_img('favicons/apple-icon-76x76.png')); ?>">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo e(assets_img('favicons/apple-icon-114x114.png')); ?>">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo e(assets_img('favicons/apple-icon-120x120.png')); ?>">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo e(assets_img('favicons/apple-icon-144x144.png')); ?>">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo e(assets_img('favicons/apple-icon-152x152.png')); ?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(assets_img('favicons/apple-icon-180x180.png')); ?>">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo e(assets_img('favicons/android-icon-192x192.png')); ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(assets_img('favicons/favicon-32x32.png')); ?>">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo e(assets_img('favicons/favicon-96x96.png')); ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(assets_img('favicons/favicon-16x16.png')); ?>">
<link rel="manifest" href="<?php echo e(assets_url('js/favicon_manifest.json')); ?>">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?php echo e(assets_img('favicons/ms-icon-144x144.png')); ?>">
<meta name="theme-color" content="#ffffff">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<link rel="stylesheet" href="<?php echo e(assets_url('css/bootstrap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(assets_url('css/font-awesome.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(assets_url('css/AdminLTE.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(assets_url('css/skin-black.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(assets_url('css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(assets_url('css/fullcalendar.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(assets_url('css/fullcalendar.print.css')); ?>" media="print">

<link rel="stylesheet" href="<?php echo e(assets_url('css/lc_switch.css')); ?>">
<link rel="stylesheet" href="<?php echo e(assets_url('css/bootstrap-datepicker3.min.css')); ?>">

<link rel="stylesheet" href="<?php echo e(assets_url('css/jquery.dataTables.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(assets_url('css/responsive.dataTables.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(assets_url('css/jquery-confirm.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(assets_url('js/vendor/jsTree/themes/default/style.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(assets_url('css/dataTables.checkboxes.css')); ?>">
<link rel="stylesheet" href="<?php echo e(assets_url('css/sites.min.css')); ?>?v=<?php echo e(filemtime(public_path() . '/assets/css/sites.min.css')); ?>">
<?php echo $__env->yieldContent('styles'); ?>

<link rel="author" href="<?php echo e(asset('humans.txt')); ?>">

<script>
    window.base_url = '<?php echo e(URL::to('/')); ?>';
</script>

</head><?php /**PATH C:\xampp8\htdocs\bank-line\resources\views/_partials/_tag_head.blade.php ENDPATH**/ ?>