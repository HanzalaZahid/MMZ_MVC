<?php 
$router->get('/', 'dashboard', 'index');
$router->get('/dashboard', 'dashboard', 'index');
$router->get('/home', 'dashboard', 'index');
// CLIENTS
$router->get('/clients', 'clients', 'index');
$router->get('/add-client', 'clients', 'add');
$router->post('/store-client', 'clients', 'store');
$router->put('/put-client', 'clients', 'put');
$router->get('/client', 'clients', 'show');
$router->get('/edit-client', 'clients', 'edit');
$router->get('/delete-client', 'clients', 'destroy');
// TRANSACTIONS
$router->get('/transactions', 'transactions', 'index');
$router->get('/transaction', 'transactions', 'show');
$router->get('/add-withdrawal', 'transactions', 'add-withdrawal');
$router->get('/add-transfer', 'transactions', 'add-transfer');
$router->post('/store-transfer', 'transactions', 'store-transfer');
$router->post('/store-withdrawal', 'transactions', 'store-withdrawal');
$router->put('/put-transaction', 'transactions', 'put');
$router->get('/edit-transaction', 'transactions', 'edit');
$router->get('/delete-transaction', 'transactions', 'destroy');
// PROJECTS
$router->get('/projects', 'projects', 'index');
$router->get('/add-project', 'projects', 'add');
$router->get('/project', 'projects', 'show');
$router->post('/store-project', 'projects', 'store');
$router->put('/put-project', 'projects', 'put');
$router->get('/edit-project', 'projects', 'edit');
$router->get('/delete-project', 'projects', 'destroy');
// PROJECT TEAMS
$router->get('/add-project-team', 'projects\teams', 'add');
$router->get('/project-team', 'projects\teams', 'show');
$router->post('/store-project-team', 'projects\teams', 'store');
$router->put('/put-project-team', 'projects\teams', 'put');
$router->get('/edit-project-team', 'projects\teams', 'edit');
// VENDORS
$router->get('/vendors', 'vendors', 'index');
$router->get('/add-vendor', 'vendors', 'add');
$router->get('/vendor', 'vendors', 'show');
$router->post('/store-vendor', 'vendors', 'store');
$router->put('/put-vendor', 'vendors', 'put');
$router->get('/delete-vendor', 'vendors', 'destroy');
$router->get('/edit-vendor', 'vendors', 'edit');
// EMPLOYEES
$router->get('/employees', 'employees', 'index');
$router->get('/add-employee', 'employees', 'add');
$router->get('/employee', 'employees', 'show');
$router->post('/store-employee', 'employees', 'store');
$router->put('/put-employee', 'employees', 'put');
$router->get('/edit-employee', 'employees', 'edit');
$router->get('/delete-employee', 'employees', 'destroy');
?>