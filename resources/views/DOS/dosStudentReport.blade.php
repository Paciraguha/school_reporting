@extends('layouts.doslayout')

@section('content')
<style>
.count-input {
    background: yellow;
    display: flex;
    flex-direction: row;
    align-content: center;
    justify-content: space-around
}

.count-input div {
    width: 100px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-around
}
</style>
<div class="flex flex-col p-4">
    <h3 class="pb-4  mb-6 w-full border-b-2 border-red-900 font-bold text-[20px]" id="reportHeader"> </h3>
    <div class="flex w-2/3 py-5 rounded-sm mb-3  mx-auto items-center">
        
        <label class="w-[40px] font-bold text-[18px]">Date:</label><input type="date" name="toDate" id="toDate" class="w-1/3 mx-3 rounded-lg " />
        <button type="button" class="w-[170px] text-[#ffff] text-1xl font-medium bg-blue-900 h-10" id="check_date"> check report</button>
    </div>
   
    
    <div class="flex gap-4">
        <div class="flex flex-col rounded-md shadow-lg p-4 w-1/2">
            <h3 class="py-2  my-4 w-full  font-extralight text-[20px]" id="table-title">
                {{ __("Student attendance Detail in nusery") }}
            </h3>
            <div class="flex w-full p-2 mx-auto" id="nusery-section">
                <table class="w-[92%] rounded-sm border-collapse border border-slate-400 text-center mx-auto">
                    <theady>
                        <tr class="border border-slate-300">
                            <td colspan="5" class="px-2 py-2 border border-slate-300">Total Registered</td>
                            <td colspan="4" class="px-2 py-2 border border-slate-300">Total Attended</td>
                        </tr>
                        <tr class="border border-slate-300">
                            <td class="px-2 py-2 border border-slate-300">No</td>
                            <td class="px-2 py-2 border border-slate-300">class</td>
                            <td class="px-2 py-2 border border-slate-300">Total</td>
                            <td class="px-2 py-2 border border-slate-300">Male</td>
                            <td class="px-2 py-2 border border-slate-300">Female</td>
                            <td class="px-2 py-2 border border-slate-300">Total</td>
                            <td class="px-2 py-2 border border-slate-300">Female</td>
                            <td class="px-2 py-2 border border-slate-300">Male</td>
                            <td class="px-2 py-2 border border-slate-300">%</td>
                        </tr>
                    </theady>

                    <tbody class="" id="nusery-section-table">
                        <tr><td>nursery report section<td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!---- primary school attendance code start here --------------------------------------------------------------------------- -->
        <div class="flex flex-col rounded-md shadow-lg p-4 w-1/2">
            <h3 class="py-2  my-4 w-full  font-extralight text-[20px]">
                {{ __("Student attendance Detail in Primary") }}
            </h3>
            <div class="" id="primary-section">
                <table class="w-[92%] rounded-sm border-collapse border border-slate-400 text-center mx-auto">
                    <theady>
                        <tr class="border border-slate-300">
                            <td colspan="5" class="px-2 py-2 border border-slate-300">Total Registered</td>
                            <td colspan="4" class="px-2 py-2 border border-slate-300">Total Attended</td>
                        </tr>
                        <tr class="border border-slate-300">
                            <td class="px-2 py-2 border border-slate-300">No</td>
                            <td class="px-2 py-2 border border-slate-300">class</td>
                            <td class="px-2 py-2 border border-slate-300">Total</td>
                            <td class="px-2 py-2 border border-slate-300">Male</td>
                            <td class="px-2 py-2 border border-slate-300">Female</td>
                            <td class="px-2 py-2 border border-slate-300">Total</td>
                            <td class="px-2 py-2 border border-slate-300">Female</td>
                            <td class="px-2 py-2 border border-slate-300">Male</td>
                            <td class="px-2 py-2 border border-slate-300">%</td>
                        </tr>
                    </theady>

                    <tbody class="" id="primary-section-table">
                    </tbody>
                </table>
            </div>
        </div>
        `
    </div>

    <!---- attendance list for secondary and TVET ---------------------------------------------------------------------------- -->
    <!--- secondary school attendance start here ------------------------------------------>
    <div class="flex gap-4 mt-6">
        <div class="flex flex-col rounded-md shadow-lg p-4 w-1/2">
            <h3 class="py-2  my-4 w-full  font-extralight text-[20px]">
                {{ __("Student attendance Detail in Secondary") }}
            </h3>
            <div class="" id="secondary-section">
                <table class="w-[92%] rounded-sm border-collapse border border-slate-400 text-center mx-auto">
                    <theady>
                        <tr class="border border-slate-300">
                            <td colspan="5" class="px-2 py-2 border border-slate-300">Total Registered</td>
                            <td colspan="4" class="px-2 py-2 border border-slate-300">Total Attended</td>
                        </tr>
                        <tr class="border border-slate-300">
                            <td class="px-2 py-2 border border-slate-300">No</td>
                            <td class="px-2 py-2 border border-slate-300">class</td>
                            <td class="px-2 py-2 border border-slate-300">Total</td>
                            <td class="px-2 py-2 border border-slate-300">Male</td>
                            <td class="px-2 py-2 border border-slate-300">Female</td>
                            <td class="px-2 py-2 border border-slate-300">Total</td>
                            <td class="px-2 py-2 border border-slate-300">Female</td>
                            <td class="px-2 py-2 border border-slate-300">Male</td>
                            <td class="px-2 py-2 border border-slate-300">%</td>
                        </tr>
                    </theady>

                    <tbody class="" id="secondary-section-table">
                    </tbody>
                </table>
            </div>
        </div>
        <!---- TVET school attendance code start here --------------------------------------------------------------------------- -->
        <div class="flex flex-col rounded-md shadow-lg p-4 w-1/2">
            <h3 class="py-2  my-4 w-full  font-extralight text-[20px]">
                {{ __("Student attendance Detail in TVET ") }}
            </h3>
            <div class="" id="tvet-section">
                <table class="w-[92%] rounded-sm border-collapse border border-slate-400 text-center mx-auto">
                    <theady>
                        <tr class="border border-slate-300">
                            <td colspan="5" class="px-2 py-2 border border-slate-300">Total Registered</td>
                            <td colspan="4" class="px-2 py-2 border border-slate-300">Total Attended</td>
                        </tr>
                        <tr class="border border-slate-300">
                            <td class="px-2 py-2 border border-slate-300">No</td>
                            <td class="px-2 py-2 border border-slate-300">class</td>
                            <td class="px-2 py-2 border border-slate-300">Total</td>
                            <td class="px-2 py-2 border border-slate-300">Male</td>
                            <td class="px-2 py-2 border border-slate-300">Female</td>
                            <td class="px-2 py-2 border border-slate-300">Total</td>
                            <td class="px-2 py-2 border border-slate-300">Female</td>
                            <td class="px-2 py-2 border border-slate-300">Male</td>
                            <td class="px-2 py-2 border border-slate-300">%</td>
                        </tr>
                    </theady>
                    <tbody class="" id="tvet-section-table">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>











<script>
$(document).ready(function() {
    const token = localStorage.getItem('auth_token');
    getStudentReportData()

    $("#check_date").click(function(){
        getStudentReportData()
    })
  
    //formValue()
    $("#submitReport").click(function() {
        saveData()
    })


function todayDate(){
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0'); // Months are 0-based, so we add 1
    const day = String(today.getDate()).padStart(2, '0');
    const formattedDate = `${year}-${month}-${day}`;
    return formattedDate
}


    // Function to remove all rows within the tbody
function removeAllRows() {
        const nuseryReport = document.getElementById("nusery-section-table")
        const primaryReport = document.getElementById("primary-section-table")
        const secondaryReport = document.getElementById("secondary-section-table")
        const tvetReport = document.getElementById("tvet-section-table")

        while (nuseryReport.firstChild) {
            nuseryReport.removeChild(nuseryReport.firstChild);
        }

        while (primaryReport.firstChild) {
            primaryReport.removeChild(primaryReport.firstChild);
        }
        while (secondaryReport.firstChild) {
            secondaryReport.removeChild(secondaryReport.firstChild);
        }
        // while (tvetReport.firstChild) {
        //     tvetReport.removeChild(tvetReport.firstChild);
        // }
}


    function getStudentReportData() {

       removeAllRows()
        const nuseryReport = document.getElementById("nusery-section-table")
        const primaryReport = document.getElementById("primary-section-table")
        const secondaryReport = document.getElementById("secondary-section-table")
        const tvetReport = document.getElementById("tvet-section-table")
        // simce it a daily report we check a report for single day and that why from date is the same as to date because I don't want to change backend logic
       // let  fromDate=document.getElementById("fromDate").value;
        let  fromDate=document.getElementById("toDate").value;
        let  toDate=document.getElementById("toDate").value;



        let formData={}
        if(fromDate!=='' && toDate!==''){
                formData={
                    fromDate,
                    toDate
                }
            }else{
                formData={
                fromDate:todayDate(),
                toDate:todayDate()
            }
        }
        document.getElementById("reportHeader").innerText="School attendance report statistic on  "+formData.toDate
        $.ajax({
            type: 'GET',
            url: '{!! route('getAllAttendanceByLevels') !!}',
            headers: {
                'Authorization': 'Bearer ' + token
            },
            data: formData,
            dataType: 'json',
            success: function(response) {
                const data = response;
                let i = 0;
                data.forEach((response) => {
                    
                    i++

                    if (response.levels == 'Nusery') {
                        const attendance = response.studentsAttendance

                        let a = 0;
                        let totalRegistered = 0
                        let totalRegisteredMale = 0
                        let totalRegisteredFemale = 0
                        let totalAttended = 0
                        let totalAttendedMale = 0
                        let totalAttendedFemale = 0
                        let totalPercentage = 0

                        if (attendance.length < 1) {
                            document.getElementById("nusery-section").innerHTML =
                                `<h3>Attendance is not yet done</h3>`
                        } else {
                            attendance.forEach(element => {
                                a++

                                totalRegistered += Number(element.totalRegistered)
                                totalRegisteredMale += Number(element.totalMale)
                                totalRegisteredFemale += Number(element.totalFemale)
                                totalAttended += Number(element.totalPresent)
                                totalAttendedMale += Number(element
                                    .totalPresentMale)
                                totalAttendedFemale += Number(element
                                    .totalPresentMale)

                                if (element.totalPresent >= element
                                    .totalRegistered / 2) {
                                    const table1 = `
                            <tr>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${a}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.SchoolClass}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalRegistered}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresent}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${(element.totalPresent*100/element.totalRegistered).toFixed(2)}</td>
                            </tr>
                            `
                                    nuseryReport.insertAdjacentHTML("beforeend",
                                        table1)
                                } else {
                                    const table1 = `
                            <tr class="bg-red-100">
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${a}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.SchoolClass}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalRegistered}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresent}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalAttendedMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${(element.totalPresent*100/element.totalRegistered).toFixed(2)}</td>
                            </tr>
                            `
                                    nuseryReport.insertAdjacentHTML("beforeend",
                                        table1)
                                }
                            })
                            const table1 = `
                            <tr class="bg-green-200">
                                 <td class="px-2 py-2 border border-b-2 border-slate-300" colspan='2'>General total</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalRegistered}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalRegisteredFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalRegisteredMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalAttended}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalAttendedFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalAttendedMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${(totalAttended*100/totalRegistered).toFixed(2)}</td>
                            </tr>
                            `
                            nuseryReport.insertAdjacentHTML("beforeend", table1)


                        }
                    }
                    // primary section ---------------------------------------------------------
                    if (response.levels == 'Primary') {
                        const attendance = response.studentsAttendance

                        let a = 0;
                        let totalRegistered = 0
                        let totalRegisteredMale = 0
                        let totalRegisteredFemale = 0
                        let totalAttended = 0
                        let totalAttendedMale = 0
                        let totalAttendedFemale = 0
                        let totalPercentage = 0

                        if (attendance.length < 1) {
                            document.getElementById("primary-section").innerHTML =
                                `<h3>Attendance is not yet done</h3>`
                        } else {
                            attendance.forEach(element => {
                                a++

                                totalRegistered += Number(element.totalRegistered)
                                totalRegisteredMale += Number(element.totalMale)
                                totalRegisteredFemale += Number(element.totalFemale)
                                totalAttended += Number(element.totalPresent)
                                totalAttendedMale += Number(element
                                    .totalPresentMale)
                                totalAttendedFemale += Number(element
                                    .totalPresentMale)

                                if (element.totalPresent >= element
                                    .totalRegistered / 2) {
                                    const table1 = `
                            <tr>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${a}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.SchoolClass}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalRegistered}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresent}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${(element.totalPresent*100/element.totalRegistered).toFixed(2)}</td>
                            </tr>
                            `
                                    primaryReport.insertAdjacentHTML("beforeend",
                                        table1)
                                } else {
                                    const table1 = `
                            <tr class="bg-red-100">
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${a}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.SchoolClass}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalRegistered}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresent}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalAttendedMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${(element.totalPresent*100/element.totalRegistered).toFixed(2)}</td>
                            </tr>
                            `
                                    primaryReport.insertAdjacentHTML("beforeend",
                                        table1)
                                }
                            })
                            const table1 = `
                            <tr class="bg-green-200">
                                 <td class="px-2 py-2 border border-b-2 border-slate-300" colspan='2'>General total</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalRegistered}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalRegisteredFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalRegisteredMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalAttended}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalAttendedFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalAttendedMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${(totalAttended*100/totalRegistered).toFixed(2)}</td>
                            </tr>
                            `
                            primaryReport.insertAdjacentHTML("beforeend", table1)


                        }
                    }
                    // secondary section ---------------------------------------------------------

                    if (response.levels == 'Secondary') {
                        const attendance = response.studentsAttendance

                        let a = 0;
                        let totalRegistered = 0
                        let totalRegisteredMale = 0
                        let totalRegisteredFemale = 0
                        let totalAttended = 0
                        let totalAttendedMale = 0
                        let totalAttendedFemale = 0
                        let totalPercentage = 0

                        if (attendance.length < 1) {
                            document.getElementById("secondary-section").innerHTML =
                                `<h3>Attendance is not yet done</h3>`
                        } else {
                            attendance.forEach(element => {
                                a++

                                totalRegistered += Number(element.totalRegistered)
                                totalRegisteredMale += Number(element.totalMale)
                                totalRegisteredFemale += Number(element.totalFemale)
                                totalAttended += Number(element.totalPresent)
                                totalAttendedMale += Number(element
                                    .totalPresentMale)
                                totalAttendedFemale += Number(element
                                    .totalPresentMale)

                                if (element.totalPresent >= element
                                    .totalRegistered / 2) {
                                    const table1 = `
                            <tr>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${a}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.SchoolClass}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalRegistered}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresent}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${(element.totalPresent*100/element.totalRegistered).toFixed(2)}</td>
                            </tr>
                            `
                                    secondaryReport.insertAdjacentHTML("beforeend",
                                        table1)
                                } else {
                                    const table1 = `
                            <tr class="bg-red-100">
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${a}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.SchoolClass}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalRegistered}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresent}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalAttendedMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${(element.totalPresent*100/element.totalRegistered).toFixed(2)}</td>
                            </tr>
                            `
                                    secondaryReport.insertAdjacentHTML("beforeend",
                                        table1)
                                }
                            })
                            const table1 = `
                            <tr class="bg-green-200">
                                 <td class="px-2 py-2 border border-b-2 border-slate-300" colspan='2'>General total</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalRegistered}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalRegisteredFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalRegisteredMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalAttended}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalAttendedFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalAttendedMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${(totalAttended*100/totalRegistered).toFixed(2)}</td>
                            </tr>
                            `
                            secondaryReport.insertAdjacentHTML("beforeend", table1)


                        }
                    }
                    // TVET section ---------------------------------------------------------
                    if (response.levels == 'TVET') {
                        const attendance = response.studentsAttendance

                        let a = 0;
                        let totalRegistered = 0
                        let totalRegisteredMale = 0
                        let totalRegisteredFemale = 0
                        let totalAttended = 0
                        let totalAttendedMale = 0
                        let totalAttendedFemale = 0
                        let totalPercentage = 0

                        if (attendance.length < 1) {
                            document.getElementById("secondary-section").innerHTML =
                                `<h3>Attendance is not yet done</h3>`
                        } else {
                            attendance.forEach(element => {
                                a++

                                totalRegistered += Number(element.totalRegistered)
                                totalRegisteredMale += Number(element.totalMale)
                                totalRegisteredFemale += Number(element.totalFemale)
                                totalAttended += Number(element.totalPresent)
                                totalAttendedMale += Number(element
                                    .totalPresentMale)
                                totalAttendedFemale += Number(element
                                    .totalPresentMale)

                                if (element.totalPresent >= element
                                    .totalRegistered / 2) {
                                    const table1 = `
                            <tr>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${a}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.SchoolClass}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalRegistered}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresent}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${(element.totalPresent*100/element.totalRegistered).toFixed(2)}</td>
                            </tr>
                            `
                                    tvetReport.insertAdjacentHTML("beforeend",
                                        table1)
                                } else {
                                    const table1 = `
                            <tr class="bg-red-100">
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${a}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.SchoolClass}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalRegistered}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresent}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${element.totalPresentFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalAttendedMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${(element.totalPresent*100/element.totalRegistered).toFixed(2)}</td>
                            </tr>
                            `
                                    tvetReport.insertAdjacentHTML("beforeend",
                                        table1)
                                }
                            })
                            const table1 = `
                            <tr class="bg-green-200">
                                 <td class="px-2 py-2 border border-b-2 border-slate-300" colspan='2'>General total</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalRegistered}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalRegisteredFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalRegisteredMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalAttended}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalAttendedFemale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${totalAttendedMale}</td>
                                <td class="px-2 py-2 border border-b-2 border-slate-300">${(totalAttended*100/totalRegistered).toFixed(2)}</td>
                            </tr>
                            `
                            tvetReport.insertAdjacentHTML("beforeend", table1)


                        }
                    }
                })
            },

            error: function(xhr, status, error) {
                // Handle errors if needed
                console.error(error);
            }
        });
    }



    function saveData() {
        // Serialize the form data
        const formData = formValue();
        // Send an AJAX request
        $.ajax({
            type: 'POST',
            url: '{!! route('addStudentsReport') !!}',
            headers: {
                'Authorization': 'Bearer ' + token

            },
            data: formData,
            dataType: 'json',
            success: function(response) {
                window.location.reload()
                console.log("------------------------------------", response);
            },
            error: function(xhr, status, error) {
                // Handle errors if needed
                console.error(error);
            }
        });
    }
})
</script>
@endsection