# Api
# Add Employee
API localhost:8000/api/register
{
    "passwords":"123456",
    "last_name":"Imtiyaz",
    "first_name":"Sk",
    "middle_name":"sad",
    "email":"imu@gmail.com",
    "address":"asdhjgahsgdsahd",
     "department_id":"1",
     "city_id":"1",
     "state_id":"1",
     "country_id":"2",
     "zip":"713101",
     "birthdate":"10/11/11",
     "date_hired":"10/11/11"
}

# Login

API: localhost:8000/api/login

{
    "email":"imu@gmail.com",
    "passwords":"123456"

}

# Edit
API localhost:8000/api/edit
{
    "emp_id":"1",
    "last_name":"Imtiyaz",
    "first_name":"Sk",
    "middle_name":"sad", 
    "address":"asdhjgahsgdsahd",
     "department_id":"1",
     "city_id":"1",
     "state_id":"1",
     "country_id":"2",
     "zip":"713101",
     "birthdate":"10/11/13",
     "date_hired":"10/11/12"
}

# Show
API GET localhost:8000/api/allEmp

