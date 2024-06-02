@extends('layouts.teacherlayout')

@section('content')
<style>
  
    .count-input{
        background:yellow;
        display:flex;
        flex-direction:row;
        align-content:center;
        justify-content:space-around
    }
    .count-input div{
        width:100px;
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:space-around
    }
</style>
<div class="container"  style="padding-left:20px;padding-right:20px;margin-right:50px;margin:auto">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="width:100%;">

                <div class="card-header">{{ __("Student list in class") }}</div>
                <div class="card-body">
                <div class="row">
                <div class="col-md-12" id="get-nusery-section-report">
                    <div class="nussery-report-section">
                        <table class="table" id="student-section-table">
                            <tr>
                                <td rowspan="2">No</td>
                                <td> School Code</td>
                                <td> Student Code</td>
                                <td> Class Level</td>
                                <td>FirstName</td>
                                <td>LastName</td>
                                <td>Gender</td>
                                <td colspan="2">Attendance</td>
                            </tr>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- submit button ----------------------------------------- -->
</div>

<script>
 $(document).ready(function() {
    getAllStudent()
    $("#addHeadTeacher-button").click(function(){
        addNewHeadTeacher()
    })

    $("#sector-options").change(function(){
        getAllSchool()
    })

    $("#school-options").change(function(){
        getAllSchoolClasses()
    })
    

        function getAllSchoolClasses(){
        const classes= document.getElementById("class-options");
        const school = document.getElementById("school-options").value;
        //const url = `/api/schools/${sector}`;
        const url=`/api/schoolClasses/${school}`;
        const myNode = document.getElementById("class-options");
        while (myNode.firstChild) {
            myNode.removeChild(myNode.lastChild);
        }
        const options=`
            <Option>select school in this sector</Option>
            `
        classes.insertAdjacentHTML("beforeend",options);

        //console.log(sector)
        $.ajax({
            type: 'GET',
            url:url,
            dataType: 'json',
            success: function(response) {
                const data=response;
                console.log(data)
                let i=0;
                data.forEach((response)=>{
                i++
                const options=`<Option value="${response.id}">${response.SchoolClass}</Option> `
                classes.insertAdjacentHTML("beforeend",options);
            })
            },
            error: function(xhr, status, error) {
                // Handle errors if needed
                console.error(error);
            }
        });
        }
        function formValue(){
        // alert("testttt")
        let SectorCode=document.getElementById("sector-options").value
        let SchoolCode=document.getElementById("school-options").value
        let ClassLevel=document.getElementById("class-options").value
        let Gender=document.getElementById("gender-options").value
        let FirstName=document.getElementById("firstName").value
        let LastName=document.getElementById("lastName").value
 

        const data={
        SchoolCode,
        ClassLevel,
        Gender,
        FirstName,
        LastName,
        }
        return data
        }

        function addNewHeadTeacher(){
                const formData =formValue();
              //  console.log(formData)
                   
                    //window.location.reload()
                }
        })

function getAllStudent(){
    const schools=document.getElementById("student-section-table")
    $.ajax({
        type: 'GET',
        url: '{!! route('getAllStudent') !!}',
        dataType: 'json',
        success: function(response) {

            const data=response;
            let i=0;
            data.forEach((response)=>{
           
           i++
            const table1=`
            <tr>
                <td id="report-expected-men-nusery">${i}</td>
                <td id="report-expected-men-nusery">${response.SchoolCode}</td>
                <td id="report-expected-men-nusery">${response.StudentCode}</td>
                <td id="report-expected-men-nusery">${response.SchoolClass}</td>
                <td id="report-expected-women-nusery">${response.FirstName}</td>
                <td id="report-expected-women-nusery">${response.LastName}</td>
                <td id="report-expected-women-nusery">${response.Gender}</td>
                <td id="report-expected-total-nusery"><button class="btn btn-primary" id="present${response.id}" onclick="attendedStudent(${response.id})">Present</button></td>
                <td id="report-attended-men-nusery"><button class="btn btn-danger" id="absent${response.id}" onclick="absentStudent(${response.id})">Absent</button></td>
            </tr>
            `

           schools.insertAdjacentHTML("beforeend",table1);
          
        })
        
        },
        error: function(xhr, status, error) {
            // Handle errors if needed
            console.error(error);
        }
    });
}


function attendedStudent(id){
    $(`#present${id}`).attr('disabled','disabled');
    $(`#absent${id}`).removeAttr('disabled');

    const formData={
        Schoolcode:id,
        Status:'Present',
        attendedDay:"2024-05-26"
    }
    $.ajax({
        type: 'POST',
        url: '{!! route('studentsAttendance') !!}',
        data: formData,
        dataType: 'json',
        success: function(response) {
            console.log(response)
            //  window.location.reload()
        },
        error: function(xhr, status, error) {
            // Handle errors if needed
            console.error(error);
        }
    });
}

function absentStudent(id){
    $(`#absent${id}`).attr('disabled','disabled');
    $(`#present${id}`).removeAttr('disabled');
    const formData={
        Schoolcode:id,
        Status:'Absent',
        attendedDay:Date.now()
    }
    $.ajax({
        type: 'POST',
        url: '{!! route('studentsAttendance') !!}',
        data: formData,
        dataType: 'json',
        success: function(response) {
            console.log(response)
            //  window.location.reload()
        },
        error: function(xhr, status, error) {
            // Handle errors if needed
            console.error(error);
        }
    });
}
</script>
@endsection


