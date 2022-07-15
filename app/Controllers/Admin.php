<?php

namespace App\Controllers;

use App\Models\EmployeeModel;

class Admin extends BaseController
{
	//function to view the admin dashboard (uses session data [user_details] from Login.php)
	public function dashboard()
	{
		//return view('');
	}

	//function to view the admin's details page (uses session data [user_details] from Login.php)
	public function adminDetails()
	{
		//return view('');
	}

	//function to view the page to edit the admin's details (uses session data [user_details] from Login.php)
	public function editAdminDetails()
	{
		//return view('');
	}

	//function to process the edit made to the admin's personal details
	public function processEditAdmin()
	{
		//Create model instance
		$editAdminModel = new EmployeeModel();

		//Retrieve the admin's employee_id
		$session = session();
        $userDetails = $session->get('user_details');
        $employee_id = $userDetails['employee_id'];

		//Retrieve form data from the editAdminDetails() page
		if($this->request->getMethod() === 'post')
        {
        	$email = $this->request->getPost('email');
            $phone_no = $this->request->getPost('phone_no');
        }

		//Send to model
		$confirmation = $editAdminModel->editEmployee($employee_id, $email, $phone_no);

		//If successful, redirect back to editAdminDetails

		//Test
		echo $confirmation;

		//return redirect()->to('');
	}

	//function to view the list of employees
	public function viewEmployees()
	{
		//Create model instance
		$viewEmployeesModel = new EmployeeModel();

		//Call model function
		$employeeList = $viewEmployeesModel->viewAllEmployees();

		//Create a session to store a list of all employees
		$session = session();
        $session->set('employeeList', $employeeList);

		//View the page
		//return view('');
	}

	//function to delete a selected employee
	public function deleteEmployee()
	{
		//Create an instance of the model
		$deleteEmployeeModel = new EmployeeModel();

		//Retrieve selected employee from the viewEmployees() [Post]
		if(isset($_GET['delete']))
	    {
	        $employee_id = $_GET['delete'];
	    }

		//Call model function
		$deleteEmployee = $deleteEmployeeModel->deleteEmployee($employee_id);

		//Redirect to viewEmployee
		//return redirect()->to('');
	}

	//function to display the page to register a new employee
	public function registerEmployee()
	{
		//return view('');
	}

	//function to process the registration of a new employee
	public function processEmployeeRegistration()
	{
		//Create model instance
		$registerEmployeeModel = new EmployeeModel();

		//Retrieve form data from registerEmployee() page [Post]
		if($this->request->getMethod() === 'post')
        {
        	$firstname = $this->request->getPost('firstname');
        	$surname = $this->request->getPost('surmane');
        	$email = $this->request->getPost('email');
            $phone_no = $this->request->getPost('phone_no');
            $password = $this->request->getPost('password');
        }

		//Call model function
		$registerEmployee = $registerEmployeeModel->registerEmployee($firstName, $surname, $email, $phone_no, $password);

		//Redirect to viewEmployee
		//return redirect()->to('');
	}

	//function to view the page to edit an employees personal details
	public function editEmployee()
	{
		//Retrieve selected employee from the viewEmployees() [Post]
		if(isset($_GET['edit']))
	    {
	        $employee_id = $_GET['edit'];
	    }

	    //Call model function
		$employeeDetails = $employeeFocusModel->employeeFocus($employee_id);

		//Create two sessions:
			//1. To store employee selected - editEmployee
			//2. To store the details of the selected employee - employeeDetails
		$session = session();
        $session->set('editEmployee', $employee_id);
        $session->set('editEmployeeDetails', $editEmployeeDetails);

        //View Page
        //return view('');
	}

	//function to process the edit of an employee's details
	public function processEmployeeEdit()
	{
		//Create an instance of the model
		$editEmployeeModel = new EmployeeModel();

		//Retrieve the employee_id of the selected employee
		$session = session();
        $employee_id = $session->get('editEmployee');

		//Retrieve form data from editEmployee() page [Post]
		if($this->request->getMethod() === 'post')
        {
        	$email = $this->request->getPost('email');
            $phone_no = $this->request->getPost('phone_no');
        }

		//Send to model
		$confirmation = $editEmployeeModel->editEmployee($employee_id, $email, $phone_no);

		//If successful, redirect back to editAdminDetails

		//Test
		echo $confirmation;

		//return redirect()->to('');
	}
}