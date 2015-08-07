<?php  namespace Acme\Forms; 

use Employee;
use Laracasts\Validation\FormValidationException;
use Laracasts\Validation\FormValidator;

class HireNewEmployeeForm extends FormValidator {

    /**
     * Validation rules for the hire new employee form.
     *
     * @var array
     */
    protected $rules = [

        'department'            => 'required|numeric|exists:departments,id',
        'branch'                => 'required|numeric|exists:branches,id',
        'firstname'             => 'required|name',
        'middlename'            => 'required|name',
        'lastname'              => 'required|name',
        'gender'                => 'required|alpha|gender',
        'birthdate'             => 'required|date|date_format:Y-m-d|before:now',
        'address'               => 'required',
        'employee_photo'        => 'mimes:jpeg,png',
        'designation'           => 'required|alpha_spaces',
        'hired_date'            => 'required|date|date_format:Y-m-d',
        'role'                  => 'required_if:create_account,checked|exists:roles,id',
        'email'                 => 'required_if:create_account,checked|email|unique:users'

    ];


    /**
     * Validate the form data
     *
     * @param  mixed $formData
     * @return mixed
     * @throws FormValidationException
     */
    public function validate($formData)
    {
        $formData = $this->normalizeFormData($formData);
        $this->validation = $this->validator->make(
            $formData,
            $this->getValidationRules(),
            $this->getValidationMessages()
        );

        if ( $this->validation->fails() ) {
            throw new FormValidationException('Validation failed', $this->getValidationErrors());
        }

        // Check employee name if exist
        $emp = Employee::where('firstname', $formData['firstname'])
            ->where('middlename', $formData['middlename'])
            ->where('lastname', $formData['lastname'])
            ->get();

        if( !$emp->isEmpty()) {
            throw new FormValidationException('Validation failed', ['error' => 'Employee already hired.']);
        }

        return true;
    }
} 