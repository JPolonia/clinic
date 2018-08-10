$(document).ready(function() {
	$('.nav-trigger').click(function() {
        $('.side-nav').toggleClass('visible');
        $('body').toggleClass('hidden');
    });
    $('.close').click(function() {
        $('.ad').css('display', 'none');
    })

    /*Bootstrap-Table - Select the row without radio or checkbox #1776 */
    var $table = $('#searchTable'); 

    $table.on('click-row.bs.table', function (e, row, $element) {
            $('.table-success').removeClass('table-success');
            $($element).addClass('table-success');
    });
    $('#buttonSearchTable').click(function () {        
            //alert('Selected ID: ' + getSelectedRow().id);
            $('#exampleModalCenter').modal('hide');
            getAjaxData( getSelectedRow().id);
    });

    document.getElementById("buttonNew").onclick = function(event) {
        alert("New Record!");

    };

    document.getElementById("buttonEdit").onclick = function(event) {
        alert("Edit Button!");
        unlockAllInputs();
    };

    document.getElementById("buttonDelete").onclick = function(event) {
        alert("Delete Button");

    };

    function getSelectedRow() {
        var index = $table.find('tr.table-success').data('index');
        return $table.bootstrapTable('getData')[index];
    }

    function getAjaxData(int) {
        xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            //alert(this.responseText);
            updateForm(JSON.parse(this.responseText));
            lockAllInputs();
            unlockEdit();
            unlockDelete();
          }
        }
        xmlhttp.open("GET","php/auxFormData.php?id="+int,true);
        xmlhttp.send();
    }

    function updateForm(patientData) {
        document.getElementById("patientInputName").value = patientData.nome;
        document.getElementById("data_nasc").value = getDate(patientData.data_nasc);
        document.getElementById("sns").value = patientData.sns;
        document.getElementById("data_1c").value = getDate(patientData.data_1c);
        document.getElementById("processo").value = patientData.processo;

        document.getElementById("morada").value = patientData.morada;
    }

    function getDate(timestamp){
        let thisDate = new Date(timestamp);
        let date = thisDate.getDate();
        let month = thisDate.getMonth(); //Be careful! January is 0 not 1
        let year = thisDate.getFullYear();
        
        month = month + 1;

        if (month < 10){
            month = "0" + month;
        }

        let dateString = year + "-" + month + "-" + date;
        return dateString; 
    }

    
    /*END Bootstrap-Table */
   

});

function lockAllInputs(){
    var inputs = document.getElementsByTagName('input'); 
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type != 'submit') {
            inputs[i].disabled = true;
        }
    }
}

function unlockAllInputs(){
    var inputs = document.getElementsByTagName('input'); 
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type != 'submit') {
            inputs[i].disabled = false;
        }
    } 
}

function unlockEdit(){
    document.getElementById("buttonEdit").disabled = false;
}

function unlockDelete(){
    document.getElementById("buttonDelete").disabled = false;
}