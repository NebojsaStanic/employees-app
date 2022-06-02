<?php

namespace api\Employees;

use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class EmployeeTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * /api/employees [GET]
     */
    public function testShouldReturnAllEmployees()
    {
        $this->get("/api/employees", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['*' =>
                 [
                     'name',
                     'position',
                     'superior',
                     'start_date',
                     'end_date'
                 ]
            ]
        );
    }

    /**
     * /api/employees/id [GET]
     */
    public function testShouldReturnEmployee()
    {
        $this->get("/api/employees/1", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                'name',
                'position',
                'superior',
                'start_date',
                'end_date'
            ]
        );
    }

    /**
     * /api/employees [POST]
     */
    public function testShouldCreateEmployee()
    {
        $data = [
            'name' => 'John',
            'position' => 'Management',
            'start_date' => '2016-01-01'
        ];

        $this->post("api/employees", $data, []);
        $this->seeStatusCode(201);
        $this->seeJsonStructure(
            [
                'name',
                'position',
                'start_date'
            ]
        );
    }

    /**
     * /api/employees/id [PUT]
     */
    public function testShouldUpdateEmployee()
    {
        $data = [
            'name' => 'John Doe',
            'position' => 'CTO'
        ];

        $this->put("api/employees/1", $data, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                'name',
                'position',
                'start_date'
            ]
        );
    }

    /**
     * /api/employees/id [DELETE]
     */
    public function testShouldDeleteEmployee(){

        $this->delete("api/employees/1", [], []);
        $this->seeJsonStructure([], 200);
    }

    /**
     * /api/filter/superior/{id}/subordinates [GET]
     */
    public function testFilterSuperiorSubordinates()
    {
        $this->get("/api/filter/superior/1/subordinates", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['*' =>
                 [
                     'name',
                     'position',
                     'superior',
                     'start_date',
                     'end_date'
                 ]
            ]
        );
    }

    /**
     * /api/filter/employees/position [GET]
     */
    public function testFilterDeveloperPosition()
    {
        $this->get("api/filter/employees/Developer", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['*' =>
                 [
                     'name',
                     'position',
                     'superior',
                     'start_date',
                     'end_date'
                 ]
            ]
        );
    }

    /**
     * /api/filter/employees/position [GET]
     */
    public function testFilterSuperiorPosition()
    {
        $this->get("api/filter/employees/Management", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['*' =>
                 [
                     'name',
                     'position',
                     'start_date',
                     'end_date'
                 ]
            ]
        );
    }
}
