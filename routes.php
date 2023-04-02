<?php 
$router->get('/', 'dashboard', 'index');
$router->get('/dashboard', 'dashboard', 'index');
$router->get('/home', 'dashboard', 'index');
// CLIENTS
$router->get('/clients', 'clients', 'index');
$router->get('/add-client', 'clients', 'add');
$router->post('/store-client', 'clients', 'store');
// TRANSACTIONS
$router->get('/transactions', 'transactions', 'index');
$router->get('/transaction', 'transactions', 'show');
$router->get('/add-withdrawal', 'transactions', 'add-withdrawal');
$router->get('/add-transfer', 'transactions', 'add-transfer');
$router->post('/store-transfer', 'transactions', 'store-transfer');
$router->post('/store-withdrawal', 'transactions', 'store-withdrawal');
// PROJECTS
$router->get('/projects', 'projects', 'index');
$router->get('/add-project', 'projects', 'add');
$router->get('/project', 'projects', 'show');
$router->post('/store-project', 'projects', 'store');
// VENDORS
$router->get('/vendors', 'vendors', 'index');
$router->get('/add-vendor', 'vendors', 'add');
$router->get('/vendor', 'vendors', 'show');
$router->post('/store-vendor', 'vendors', 'store');
$router->get('/delete-vendor', 'vendors', 'delete');
// EMPLOYEES
$router->get('/employees', 'employees', 'index');
$router->get('/add-employee', 'employees', 'add');
$router->get('/employee', 'employees', 'show');
$router->post('/store-employee', 'employees', 'store');
?>