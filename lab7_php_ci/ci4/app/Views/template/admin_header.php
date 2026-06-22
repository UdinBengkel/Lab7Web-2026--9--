<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Admin Panel'; ?></title>
    <link rel="stylesheet" href="<?= base_url('/style.css'); ?>">
    <style>
        #admin-nav { background: #1e3a5f; padding: 0; overflow: hidden; }
        #admin-nav a { display: inline-block; padding: 12px 20px; color: #fff; text-decoration: none; font-size: 14px; }
        #admin-nav a:hover { background: #2c5282; }
        #admin-nav a.logout { float: right; background: #c0392b; }
        #admin-nav a.logout:hover { background: #922b21; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { padding: 10px 12px; border: 1px solid #ddd; text-align: left; font-size: 13px; }
        .table thead th { background: #2c5282; color: #fff; }
        .table tbody tr:nth-child(even) { background: #f8f9fa; }
        .table tfoot th { background: #eee; }
    </style>
</head>
<body>
    <div id="container">
        <header>
            <h1>Admin Panel — <?= session()->get('user_name') ?? ''; ?></h1>
        </header>
        <nav id="admin-nav">
            <a href="<?= base_url('/admin/artikel'); ?>">Daftar Artikel</a>
            <a href="<?= base_url('/admin/artikel/add'); ?>">Tambah Artikel</a>
            <a href="<?= base_url('/user/logout'); ?>" class="logout">Logout</a>
        </nav>
        <section id="wrapper">
            <section id="main">