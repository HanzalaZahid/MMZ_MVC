<?php
    $page_title =   "Edit Employeee";
    core('Additional');
    if(isset($_GET['employee_id'])  &&  !empty($_GET['employee_id'])){

        $employee_id    =   $_GET['employee_id'];
        models('Employees');
        $employeesModel  =   new Employees($config);
        $employeeData   =   $employeesModel->get($employee_id);
        $args['employee']   =   $employeeData;
        // echo "<pre>";
        //     var_dump($employeeData);
        // echo "</pre>";
        $additional =   new core\Additional($config);
        $cities =   $additional->getCities();
        $banks  =   $additional->getBanks();
        $categories  =   $additional->getEmployeeCategory();
        $args['cities'] =   $cities;
        $args['banks'] =   $banks;
        $args['categories'] =   $categories;
        if (isset($_GET['errors'])){
            $args['errors'] =   unserialize(urldecode($_GET['errors']));
        }       
    } else{
        abort();
    }
    view('employees', 'add', $args);
?>