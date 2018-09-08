/*Bootstrap-Table - Select the row without radio or checkbox #1776 */
var $table = $('#searchTable');

$table.on('click-row.bs.table', function (e, row, $element) {
    $('.table-success').removeClass('table-success');
    $($element).addClass('table-success');
});


$('#buttonSearchTable').click(function () {
    //alert('Selected ID: ' + getSelectedRow().id_processo);
    $('#exampleModalCenter').modal('hide');
    getAjaxData(getSelectedRow().id_processo);
});

/*
    State:  0 - Dummy
            1 - Edit Record
            2 - New Record
*/

let state = 0;
lockAllInputs();


document.getElementById("buttonNew").addEventListener("click", handleEventNew);
document.getElementById("buttonEdit").addEventListener("click", handleEventEdit);
document.getElementById("buttonDelete").addEventListener("click", handleEventDelete);
document.getElementById("buttonSave").addEventListener("click", handleEventSave);
document.getElementById("buttonInsert").addEventListener("click", handleEventInsert);
document.getElementById("buttonNewBio").addEventListener("click", handleEventNewBio);

function handleEventNew() {
    state = 2;
    resetForm();
    unlockAllInputs();
    focusElem("nome");
    showElem("buttonInsert");
    showElem("buttonDelete");
    hideElem("buttonEdit");
    hideElem("buttonNew");
    hideElem("buttonSave");

    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //alert(this.responseText);
            clearStaticData();
            fillStaticData(JSON.parse(this.responseText).localList);
        }
    }
    xmlhttp.open("GET", "php/ajax_list_staticfields.php", true);
    xmlhttp.send();
}
function handleEventEdit() {
    unlockAllInputs();
    showElem("buttonDelete");
}
function handleEventDelete() {
    state = 0;
    resetForm();
    lockAllInputs();
    //Show
    showElem("buttonNew");
    //Hide 
    hideElem("buttonInsert");
    hideElem("buttonSave");
    hideElem("buttonDelete");
    hideElem("ButtonEdit");
}
function handleEventNewBio() { //Add new card to the accordion
    //Get Accordion to append child
    let accordion = document.getElementById("accordionBio");
    //Clone template
    let tempNode = document.querySelector("div[data-type='template_biopsia']").cloneNode(true); //true for deep clone
    //Count number of cards
    let num = accordion.childElementCount;
    //alert(num);
    num = num + 1;

    //Change accordion card ids
    tempNode.classList.remove('d-none');
    tempNode.querySelector("div[data-parent='#accordionBio']").id = "collapse" + num;
    tempNode.querySelector("div[data-parent='#accordionBio']").classList.add('show');
    tempNode.querySelector(".card-link").href = "#collapse" + num;
    tempNode.querySelector(".card-link").innerHTML = num + "ª Biopsia";

    //Change input ids
    //completar...

    //Collapse other cards
    $('#accordionBio .collapse').collapse('hide');

    accordion.appendChild(tempNode);
    //alert(accordion);
}

function handleEventInsert() {
    //alert("Save Pressed");
    let form = document.getElementById("formProcesso");
    let form_data = new FormData(form);
    for ([key, value] of form_data.entries()) {
        console.log(key + ': ' + value);
    }
    //let action = form.getAttribute("action");
    let xhr = new XMLHttpRequest();
    xhr.open('POST', "php/ajax_insert_patient.php", true);
    xhr.overrideMimeType('text/xml; charset=UTF-8');
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            //alert(JSON.parse(xhr.responseText).nome);
            let result = xhr.responseText;
            console.log("Result:" + result);

            /*Update Process ID*/
        }
    };
    xhr.send(form_data);
}

function handleEventSave() { }


let form = document.forms.namedItem("formProcesso");
form.addEventListener('submit', function (ev) {
    /*
       //let oOutput = document.querySelector("div");
       let oData = new FormData(form);
    
       oData.append("CustomField", "This is some extra data");
    
       var oReq = new XMLHttpRequest();
       oReq.open("POST", "ajax_insert_patient.php", true);
       oReq.onload = function (oEvent) {
           if (oReq.status == 200) {
               alert("Uploaded!");
           } else {
               alert("Error " + oReq.status + " occurred when trying to upload your file.<br \/>");
           }
       };
    
       oReq.send(oData);*/
    ev.preventDefault();
}, false);

//Rastreio
function rastreioFieldsetChange(elem, id) {
    let fieldset = document.getElementById(id);

    if (elem.checked == false) {
        fieldset.disabled = true;
        fieldset.classList.add('d-none'); //Select parent col
    } else {
        fieldset.disabled = false;
        fieldset.classList.remove('d-none');
    }
}

/*BIOPSIA*/
//Biopsia Fieldsets
function bioFieldsetChange(elem, id) {
    let fieldset = document.getElementById(id);

    if (elem.checked == false) {
        fieldset.disabled = true;
        fieldset.parentNode.classList.add('d-none'); //Select parent col
    } else {
        fieldset.disabled = false;
        fieldset.parentNode.classList.remove('d-none');
    }

}

function bioCORECAAF(id) {
    let radiobtn = document.getElementById(id);
    radiobtn.checked = true;
}

function bioINCISIONAL(id) {
    clearSelected(id);
}

function clearSelected(id) {
    let elements = document.getElementById(id).options;

    for (let i = 0; i < elements.length; i++) {
        elements[i].selected = false;
    }
}
/*BIOPSIA*/

function getSelectedRow() {
    let index = $table.find('tr.table-success').data('index');
    return $table.bootstrapTable('getData')[index];
}

function getAjaxData(id) {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //alert(this.responseText);
            clearStaticData();
            fillStaticData(JSON.parse(this.responseText).localList);
            updateForm(JSON.parse(this.responseText).processo, JSON.parse(this.responseText).images);
            lockAllInputs();
            hideElem("buttonSave");
            hideElem("buttonDelete");
            showElem("buttonNew");
            showElem("buttonEdit");
        }
    }
    xmlhttp.open("GET", "php/ajax_list_process.php?id=" + id, true);
    xmlhttp.send();
}

function updateForm(patientData, images) {
    document.getElementById("nome").value = patientData.nome;
    document.getElementById("data_nasc").value = getDate(patientData.data_nasc);
    document.getElementById("idade").value = getAge(patientData.data_nasc);
    document.getElementById("sns").value = patientData.sns;
    document.getElementById("data_1c").value = getDate(patientData.data_1c);
    document.getElementById("id_processo").value = patientData.id_processo;
    document.getElementById("n_proc").value = patientData.n_proc;
    document.getElementById("morada").value = patientData.morada;
    document.getElementById("estado_civil").value = patientData.estado_civil;

    /*Rastreio*/
    //document.getElementById("naoRadioRastreio").checked = patientData.id_rastreio == null ? true : false;
    //document.getElementById("simRadioRastreio").checked = patientData.id_rastreio == null ? false : true;
    document.getElementById("n_conc_volta").value = patientData.n_conc_volta;
    document.getElementById("data_rastreio").value = patientData.data_rastreio;
    document.getElementById("data_afericao").value = patientData.data_afericao;

    /*Localizacao*/
    document.getElementById("localizacaoSelectMamaD").selectedIndex = patientData.id_local_drt;
    document.getElementById("localizacaoSelectMamaE").selectedIndex = patientData.id_local_esq;

    /*Imagem*/
    for (let i = 0; i < images.length; i++) {
        if (images[i].img_activo == 1) {
            switch (images[i].tipo_imagem) {
                case "Mamografia":
                    document.getElementById("mamografiaSelect").selectedIndex = images[i].bi_rads;
                    break;
                case "Ecografia":
                    document.getElementById("ecografiaSelect").selectedIndex = images[i].bi_rads;
                    break;
                case "RM":
                    document.getElementById("RMSelect").selectedIndex = images[i].bi_rads;
                    break;
                case "Tomosintese":
                    document.getElementById("tomosinteseSelect").selectedIndex = images[i].bi_rads;
                    break;
                default:
                    break;
            }
        }
    }

    /*Biopsia*/
}

function getDate(timestamp) {
    let thisDate = new Date(timestamp);
    let date = thisDate.getDate();
    let month = thisDate.getMonth(); //Be careful! January is 0 not 1
    let year = thisDate.getFullYear();

    month = month + 1;

    if (month < 10) {
        month = "0" + month;
    }

    let dateString = year + "-" + month + "-" + date;
    return dateString;
}

function getAge(timestamp) {
    let dob = new Date(timestamp);
    let diff_ms = Date.now() - dob.getTime();
    let age_dt = new Date(diff_ms);

    return Math.abs(age_dt.getUTCFullYear() - 1970);
}

/*Preenche combobox com valores por defeito*/
function fillStaticData(localList) {

    //Append Locallist
    let selectDrt = document.getElementById('localizacaoSelectMamaD');
    let selectEsq = document.getElementById('localizacaoSelectMamaE');

    for (let i = 0; i < localList.length; i++) {
        let opt = document.createElement('option');
        opt.value = localList[i].id_local;
        opt.innerHTML = localList[i].abreviatura;
        let cln = opt.cloneNode(true);
        selectDrt.appendChild(opt);
        selectEsq.appendChild(cln);
    }

    //Append BI-RADS
    let mamo = document.getElementById('mamografiaSelect');
    let eco = document.getElementById('ecografiaSelect');
    let rm = document.getElementById('RMSelect');
    let tomo = document.getElementById('tomosinteseSelect');

    for (let i = 1; i <= 5; i++) {
        if (i == 4) {
            let opta = document.createElement('option');
            let optb = document.createElement('option');
            let optc = document.createElement('option');
            opta.value = i + "A";
            opta.innerHTML = "BI-RADS " + i + "A";
            mamo.appendChild(opta.cloneNode(true));
            eco.appendChild(opta.cloneNode(true));
            rm.appendChild(opta.cloneNode(true));
            tomo.appendChild(opta.cloneNode(true));
            optb.value = i + "A";
            optb.innerHTML = "BI-RADS " + i + "B";
            mamo.appendChild(optb.cloneNode(true));
            eco.appendChild(optb.cloneNode(true));
            rm.appendChild(optb.cloneNode(true));
            tomo.appendChild(optb.cloneNode(true));
            optc.value = i + "A";
            optc.innerHTML = "BI-RADS " + i + "C";
            mamo.appendChild(optc.cloneNode(true));
            eco.appendChild(optc.cloneNode(true));
            rm.appendChild(optc.cloneNode(true));
            tomo.appendChild(optc.cloneNode(true));
        } else {
            let opt = document.createElement('option');
            opt.value = i;
            opt.innerHTML = "BI-RADS " + i;
            mamo.appendChild(opt.cloneNode(true));
            eco.appendChild(opt.cloneNode(true));
            rm.appendChild(opt.cloneNode(true));
            tomo.appendChild(opt.cloneNode(true));
        }
    }

    //Append Biopsias Tecnicas
}

/*Elimina combobox com valores por defeito*/
function clearStaticData() {
    let selectDrt = document.getElementById('localizacaoSelectMamaD');
    let selectEsq = document.getElementById('localizacaoSelectMamaE');

    while (selectDrt.firstChild) {
        selectDrt.removeChild(selectDrt.firstChild);
    }
    while (selectEsq.firstChild) {
        selectEsq.removeChild(selectEsq.firstChild);
    }

    //Delete BI-RADS
    let mamo = document.getElementById('mamografiaSelect');
    let eco = document.getElementById('ecografiaSelect');
    let rm = document.getElementById('RMSelect');
    let tomo = document.getElementById('tomosinteseSelect');

    while (mamo.firstChild) {
        mamo.removeChild(mamo.firstChild);
    }
    while (eco.firstChild) {
        eco.removeChild(eco.firstChild);
    }
    while (rm.firstChild) {
        rm.removeChild(rm.firstChild);
    }
    while (tomo.firstChild) {
        tomo.removeChild(tomo.firstChild);
    }


    //Add Slash element "-"
    let slash = document.createElement('option');
    slash.value = 0;
    slash.innerHTML = "-";
    selectDrt.appendChild(slash);
    selectEsq.appendChild(slash.cloneNode(true));
    mamo.appendChild(slash.cloneNode(true));
    eco.appendChild(slash.cloneNode(true));
    rm.appendChild(slash.cloneNode(true));
    tomo.appendChild(slash.cloneNode(true));
}

/*END Bootstrap-Table */

function lockAllInputs() {
    let inputs = document.getElementsByTagName('input');
    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].type != 'submit') {
            inputs[i].disabled = true;
        }
    }
    let selects = document.getElementsByTagName('select');
    for (i = 0; i < selects.length; i++) {
        selects[i].disabled = true;

    }
}

function unlockAllInputs() {
    let inputs = document.getElementsByTagName('input');
    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].type != 'submit') {
            inputs[i].disabled = false;
            inputs[i].placeholder = "";
        }
    }
    let selects = document.getElementsByTagName('select');
    for (i = 0; i < selects.length; i++) {
        selects[i].disabled = false;

    }
}

function resetForm() {
    document.getElementById('formProcesso').reset();
}

function enableElem(id) {
    document.getElementById(id).disabled = false;
}
function disableElem(id) {
    document.getElementById(id).disabled = true;
}
function showElem(id) {
    document.getElementById(id).classList.remove('d-none');
}
function hideElem(id) {
    document.getElementById(id).classList.add('d-none');
}
function focusElem(id) {
    document.getElementById(id).focus();
}
function editMode(btn, id) {
    document.getElementById(id).disabled = false;
    btn.innerHTML = "<i class='fa fa-check'></i>";
    let onclickStr = "okMode(this,'" + id + "')";
    btn.setAttribute('onclick', onclickStr);
}
function okMode(btn, id) {
    document.getElementById(id).disabled = true;
    btn.innerHTML = "<i class='fa fa-pencil'></i>";
    let onclickStr = "editMode(this,'" + id + "')";
    btn.setAttribute('onclick', onclickStr);
}