@extends('layouts.school')

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

                <div class="card-header">{{ __("Schools Teachers") }}</div>
                <div class="card-body">
                <div class="row">
                <div class="col-md-12" id="get-nusery-section-report">
                    <div class="nussery-report-section">
                        <table class="table" id="teacher-section-table">
                            <tr>
                                <td rowspan="2">No</td>
                                <td> Name</td>
                                <td>email</td>
                                <td>telephone</td>
                                <td>SchoolName</td>
                                <td>Class</td>
                                <td>Assign new class<td>
                                <td colspan="3">Actions</td>
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

async function testButton (){
    let dropdownList=[];
    let  classDropDown="";
    const schoolTeachers=document.getElementById("teacher-section-table")
    const response = await fetch(`{!! route('apiGetSchoolClass') !!}`);
    const schoolClasses = await response.json();
    let i=0;
    schoolClasses.forEach((elem)=>{
            i++
            options=`<Option value="${elem.id}">${elem.SchoolClass}</Option> `
            dropdownList.push(options)
    })

   
    const response1 = await fetch(`{!! route('apiGetAllSchoolTeachers') !!}`);
    const teachers = await response1.json();
        let b=0;
        teachers.forEach((elem)=>{
        b++
        const table=`
            <tr>
                <td class="teacher-list-${elem.id}" >${b}</td>
                <td class="teacher-list-${elem.id}">${elem.firstName} ${elem.lastName}</td>
                <td class="teacher-list-${elem.id}">${elem.email}</td>
                <td class="teacher-list-${elem.id}">${elem.Telephone}</td>
                <td class="teacher-list-${elem.id}">${elem.SchoolName}</td>
                <td class="teacher-list-${elem.id}">${elem.SchoolClass}</td>
                <td class="teacher-list-${elem.id}"><select class="form-control" id="${elem.id}">${dropdownList}</select></td>
                <td class="teacher-list-${elem.id}"><button id="save_${elem.id}" class="btn" onclick="assignClaasToTeacher(${elem.id})">Save</button></td>
                <td class="teacher-list-${elem.id}"><button id="edit_${elem.id}" class="btn btn-primary" onclick="assignClaasToTeacher(${elem.id})">Edit </button></td>
                <td class="teacher-list-${elem.id}"><button id="delete_${elem.id}" class="btn btn-danger" onclick="assignClaasToTeacher(${elem.id})">Delete</button></td>
            </tr>`
            schoolTeachers.insertAdjacentHTML("beforeend",table);
        })
    
}


testButton();
 
 function assignClaasToTeacher(id){
    const el=document.getElementById(id)
    const classes=el.options[el.selectedIndex].value;
    const data={
        TeacherId:id ,
        ClassId:classes
    }
    console.log(data)
    const saveData=  fetch(`{!! route('apiAssignClassToTeacher') !!}`,{
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },

        method: 'post',
        body:JSON.stringify(data),
    })
    .then(response => response.json())
    .then(result => {
    console.log('Success:', result);
    window.location.reload()
    })
}





</script>
@endsection


