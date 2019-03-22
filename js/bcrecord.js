/*Bootstrap-Table - Select the row without radio or checkbox #1776 */
let $table = $('#searchTableModal'); //Modal
$table.on('click-row.bs.table', function (e, row, $element) {
    $('.table-success').removeClass('table-success');
    $($element).addClass('table-success');
});
/*End #1776 */

$('[data-toggle="tooltip"]').tooltip();


/*
    State:  0 - Dummy
            1 - Edit Record
            2 - New Record
*/

let state = 0;
lockAllInputs();

document.getElementById("buttonOpenRecord").addEventListener("click", btnOpenRegisto);
document.getElementById("buttonNew").addEventListener("click", btnNewProcesso);
document.getElementById("buttonEdit").addEventListener("click", btnEditProcesso);
document.getElementById("buttonDelete").addEventListener("click", btnDeleteProcesso);
document.getElementById("buttonSave").addEventListener("click", btnSaveProcesso);
document.getElementById("buttonInsert").addEventListener("click", btnInsertProcesso);
document.getElementById("buttonNewBio").addEventListener("click", btnNewBiopsia);
document.getElementById("buttonNewCir").addEventListener("click", btnNewCirurgia);


function btnOpenRegisto() {
    //alert('Selected ID: ' + getSelectedRow().id_processo);
    $('#openRegistoModal').modal('hide');
    getAjaxData(getSelectedRow().id_processo);
}
function btnNewProcesso() {
    state = 2;
    resetForm(); //Clears all inputs
    unlockAllInputs();
    focusElem("nome");
    showElem("buttonInsert");
    showElem("buttonDelete");
    hideElem("buttonEdit");
    hideElem("buttonNew");
    hideElem("buttonSave");

    fillStaticData('dummy');

    fillSampleForm();

    /*xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //alert(this.responseText);
            clearStaticData();
            fillStaticData(JSON.parse(this.responseText).localList);
        }
    }
    xmlhttp.open("GET", "php/ajax_list_staticfields.php", true);
    xmlhttp.send();*/
}
function btnEditProcesso() {
    unlockAllInputs();
    showElem("buttonDelete");
}
function btnDeleteProcesso() {
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
function btnSaveProcesso() {

}
function btnInsertProcesso() {
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

            //Update Process ID
        }
    };
    xhr.send(form_data);
}
function btnNewBiopsia() { //Add new card to the accordion
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

    //Change data_biopsia id,name and label
    let databiopsia = tempNode.querySelector("#data_biopsia");
    databiopsia.id += num;
    databiopsia.setAttribute('name', databiopsia.id);
    let labeldatabiopsia = databiopsia.previousSibling.previousSibling;
    labeldatabiopsia.htmlFor = databiopsia.id;

    let zona = ["MamaDta", "MamaEsq", "AxilaDta", "AxilaEsq"];
    zona.forEach(function (value, index) {
        //console.log('Element #' + index + ' is ' + value);

        //Change check ids, names and labels
        let checkZona = tempNode.querySelector("#check" + value);
        let onChangeCheckZona = "FieldsetChange(this,'" + value + num + "')";
        checkZona.setAttribute('onchange', onChangeCheckZona);
        checkZona.id += num;
        checkZona.setAttribute('name', checkZona.id);
        let labelZona = checkZona.nextSibling.nextSibling;
        labelZona.htmlFor = checkZona.id;

        //Change fieldsets ids
        let thisZona = tempNode.querySelector("#" + value);
        thisZona.id += num;

        //Change resultado id, name and labels
        let resultZona = tempNode.querySelector("#resultadoSelect" + value);
        resultZona.id += num;
        resultZona.setAttribute('name', resultZona.id);
        let labelresultZona = resultZona.previousSibling.previousSibling;
        labelresultZona.htmlFor = resultZona.id;

        //Change tipo id, name and labels 
        let tipoZona = tempNode.querySelector("#tipoBiopsiaSelect" + value);
        tipoZona.id += num;
        tipoZona.setAttribute('name', tipoZona.id);
        let labeltipoZona = tipoZona.previousSibling.previousSibling;
        labeltipoZona.htmlFor = tipoZona.id;

        //Change forma id, name and labels - ONLY FOR MAMA
        if (index < 2) {
            let formaZona = tempNode.querySelector("#formaBiopsiaSelect" + value);
            formaZona.id += num;
            formaZona.setAttribute('name', formaZona.id);
            let labelformaZona = formaZona.previousSibling.previousSibling;
            labelformaZona.htmlFor = formaZona.id;
        }

    });

    //Collapse other cards
    $('#accordionBio .collapse').collapse('hide');

    //Append Node
    accordion.appendChild(tempNode);
}
function btnNewCirurgia() { //Add new card to the accordion
    //Get Accordion to append child
    let accordion = document.getElementById("accordionCir");
    //Clone template
    let tempNode = document.querySelector("div[data-type='template_cirurgia']").cloneNode(true); //true for deep clone
    //Count number of cards
    let num = accordion.childElementCount;
    //alert(num);
    num = num + 1;

    //Change accordion card ids
    tempNode.classList.remove('d-none');
    tempNode.querySelector("div[data-parent='#accordionCir']").id = "collapseCir" + num;
    tempNode.querySelector("div[data-parent='#accordionCir']").classList.add('show');
    tempNode.querySelector(".card-link").href = "#collapseCir" + num;
    tempNode.querySelector(".card-link").innerHTML = num + "ª Cirurgia";

    //Change data_cirurgia id,name and label
    let datacirurgia = tempNode.querySelector("#data_cirurgia");
    datacirurgia.id += num;
    datacirurgia.setAttribute('name', datacirurgia.id);
    let labeldatacirurgia = datacirurgia.previousSibling.previousSibling;
    labeldatacirurgia.htmlFor = datacirurgia.id;

    //Change lic id,name and label
    let lic = tempNode.querySelector("#lic");
    lic.id += num;
    lic.setAttribute('name', lic.id);
    let labellic = lic.previousSibling.previousSibling;
    labellic.htmlFor = lic.id;

    let zona = ["MamaDta", "MamaEsq", "AxilaDta", "AxilaEsq"];
    zona.forEach(function (value, index) {
        //console.log('Element #' + index + ' is ' + value);

        //Change check ids, names and labels
        let checkZona = tempNode.querySelector("#checkCir" + value);
        let onChangeCheckZona = "FieldsetChange(this,'Cir" + value + num + "')";
        checkZona.setAttribute('onchange', onChangeCheckZona);
        checkZona.id += num;
        checkZona.setAttribute('name', checkZona.id);
        let labelZona = checkZona.nextSibling.nextSibling;
        labelZona.htmlFor = checkZona.id;

        //Change fieldsets ids
        let thisZona = tempNode.querySelector("#Cir" + value);
        thisZona.id += num;

        //Change tecnica id, name and labels 
        let tecnicaZona = tempNode.querySelector("#tecnicaCirSelect" + value);
        tecnicaZona.id += num;
        tecnicaZona.setAttribute('name', tecnicaZona.id);
        let labeltecnicaZona = tecnicaZona.previousSibling.previousSibling;
        labeltecnicaZona.htmlFor = tecnicaZona.id;

        //Change reconstrucao id, name and labels - ONLY FOR MAMA
        if (index < 2) {
            let reconZona = tempNode.querySelector("#reconstrucaoCirSelect" + value);
            reconZona.id += num;
            reconZona.setAttribute('name', reconZona.id);
            let labelreconZona = reconZona.previousSibling.previousSibling;
            labelreconZona.htmlFor = reconZona.id;
        }

    });

    //Collapse other cards
    $('#accordionCir .collapse').collapse('hide');

    //Append Node
    accordion.appendChild(tempNode);
}

function FieldsetChange(elem, id) { //Biopsia/Cirurgia/Rastreio Fieldsets
    let fieldset = document.getElementById(id);
    if (elem.checked == false) {
        fieldset.disabled = true;
        if (id == "fldsetRastreio")
            fieldset.classList.add('d-none');
        else
            fieldset.parentNode.classList.add('d-none');  //Select parent col
    } else {
        fieldset.disabled = false;
        if (id == "fldsetRastreio")
            fieldset.classList.remove('d-none');
        else
            fieldset.parentNode.classList.remove('d-none');
    }
}

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

    /*//Append Locallist
    let selectDrt = document.getElementById('localizacaoSelectMamaD');
    let selectEsq = document.getElementById('localizacaoSelectMamaE');

    for (let i = 0; i < localList.length; i++) {
        let opt = document.createElement('option');
        opt.value = localList[i].id_local;
        opt.innerHTML = localList[i].abreviatura;
        let cln = opt.cloneNode(true);
        selectDrt.appendChild(opt);
        selectEsq.appendChild(cln);
    }*/

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
            opta.value = i;
            opta.innerHTML = "BI-RADS " + i + "A";
            mamo.appendChild(opta.cloneNode(true));
            eco.appendChild(opta.cloneNode(true));
            rm.appendChild(opta.cloneNode(true));
            tomo.appendChild(opta.cloneNode(true));
            optb.value = i + 1;
            optb.innerHTML = "BI-RADS " + i + "B";
            mamo.appendChild(optb.cloneNode(true));
            eco.appendChild(optb.cloneNode(true));
            rm.appendChild(optb.cloneNode(true));
            tomo.appendChild(optb.cloneNode(true));
            optc.value = i + 2;
            optc.innerHTML = "BI-RADS " + i + "C";
            mamo.appendChild(optc.cloneNode(true));
            eco.appendChild(optc.cloneNode(true));
            rm.appendChild(optc.cloneNode(true));
            tomo.appendChild(optc.cloneNode(true));
        } else if (i == 5) {
            let opt = document.createElement('option');
            opt.value = i + 2;
            opt.innerHTML = "BI-RADS " + i;
            mamo.appendChild(opt.cloneNode(true));
            eco.appendChild(opt.cloneNode(true));
            rm.appendChild(opt.cloneNode(true));
            tomo.appendChild(opt.cloneNode(true));
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

    opt = document.createElement('option');
    opt.value = i;
    opt.innerHTML = "Não Realizado";
    mamo.appendChild(opt.cloneNode(true));
    eco.appendChild(opt.cloneNode(true));
    rm.appendChild(opt.cloneNode(true));
    tomo.appendChild(opt.cloneNode(true));

    opt = document.createElement('option');
    opt.value = i;
    opt.innerHTML = "Não Classificado";
    mamo.appendChild(opt.cloneNode(true));
    eco.appendChild(opt.cloneNode(true));
    rm.appendChild(opt.cloneNode(true));
    tomo.appendChild(opt.cloneNode(true));

    opt = document.createElement('option');
    opt.value = i;
    opt.innerHTML = "Desconhecido";
    mamo.appendChild(opt.cloneNode(true));
    eco.appendChild(opt.cloneNode(true));
    rm.appendChild(opt.cloneNode(true));
    tomo.appendChild(opt.cloneNode(true));

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
    //Select only form
    let form = document.getElementById('formProcesso');

    //Lock all form inputs
    let inputs = form.getElementsByTagName('input');
    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].type != 'submit') {
            inputs[i].disabled = true;
        }
    }
    //Lock all form selects
    let selects = form.getElementsByTagName('select');
    for (i = 0; i < selects.length; i++) {
        selects[i].disabled = true;

    }
    //Lock all form buttons
    let buttons = form.getElementsByTagName('button');
    for (i = 0; i < buttons.length; i++)
        buttons[i].disabled = true;
}

function unlockAllInputs() {
    //Select only form
    let form = document.getElementById('formProcesso');

    //Unlock inputs
    let inputs = form.getElementsByTagName('input');
    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].type != 'submit') {
            inputs[i].disabled = false;
            inputs[i].placeholder = "";
        }
    }
    //Unlock selects
    let selects = form.getElementsByTagName('select');
    for (i = 0; i < selects.length; i++) {
        selects[i].disabled = false;

    }
    //Unlock all form buttons
    let buttons = form.getElementsByTagName('button');
    for (i = 0; i < buttons.length; i++)
        buttons[i].disabled = false;
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
    btn.innerHTML = "<i class='fa fa-pencil-square-o'></i>";
    let onclickStr = "editMode(this,'" + id + "')";
    btn.setAttribute('onclick', onclickStr);
}



function fillSampleForm() {
    document.getElementById("nome").value = "Maria Margarida Botelho";
    document.getElementById("data_nasc").value = getDate("1970-08-14");
    document.getElementById("idade").value = getAge("1970-08-14");
    document.getElementById("sns").value = 576123138;
    document.getElementById("data_1c").value = getDate("2015-08-14");
    document.getElementById("n_processo").value = 123456;
    document.getElementById("n_proc").value = 1;
    document.getElementById("morada").value = "624 Amerige Ave Kingsport, TN 37660";
    document.getElementById("estado_civil").value = "Casada";

    /*Rastreio*/
    document.getElementById("checkRastreio").checked = true;
    FieldsetChange(document.getElementById("checkRastreio"), 'fldsetRastreio');
    document.getElementById("n_conc_volta").value = "123/Porto/12";
    document.getElementById("data_rastreio").value = getDate("2015-08-14");
    document.getElementById("data_afericao").value = getDate("2015-08-14");

    /*Localizacao*/
    document.getElementById("localizacaoSelectMamaD").selectedIndex = 3;
    document.getElementById("localizacaoSelectMamaE").selectedIndex = 1;

    /*Imagem*/
    document.getElementById("mamografiaSelect").selectedIndex = 2;
    document.getElementById("ecografiaSelect").selectedIndex = 0;
    document.getElementById("RMSelect").selectedIndex = 5;
    document.getElementById("tomosinteseSelect").selectedIndex = 1;

    /*Biopsia*/
    btnNewBiopsia();
    document.getElementById("data_biopsia1").value = getDate("2015-08-14");
    document.getElementById("checkMamaDta1").checked = true;
    FieldsetChange(document.getElementById("checkMamaDta1"), 'MamaDta1');
    document.getElementById("checkMamaEsq1").checked = true;
    FieldsetChange(document.getElementById("checkMamaEsq1"), 'MamaEsq1');
    document.getElementById("checkAxilaDta1").checked = true;
    FieldsetChange(document.getElementById("checkAxilaDta1"), 'AxilaDta1');
    document.getElementById("checkAxilaEsq1").checked = true;
    FieldsetChange(document.getElementById("checkAxilaEsq1"), 'AxilaEsq1');
    document.getElementById("resultadoSelectMamaDta1").selectedIndex = 2;
    document.getElementById("tipoBiopsiaSelectMamaDta1").selectedIndex = 3;
    document.getElementById("formaBiopsiaSelectMamaDta1").selectedIndex = 1;
    document.getElementById("resultadoSelectMamaEsq1").selectedIndex = 1;
    document.getElementById("tipoBiopsiaSelectMamaEsq1").selectedIndex = 2;
    document.getElementById("formaBiopsiaSelectMamaEsq1").selectedIndex = 1;
    document.getElementById("resultadoSelectAxilaDta1").selectedIndex = 2;
    document.getElementById("tipoBiopsiaSelectAxilaDta1").selectedIndex = 3;
    document.getElementById("resultadoSelectAxilaEsq1").selectedIndex = 2;
    document.getElementById("tipoBiopsiaSelectAxilaEsq1").selectedIndex = 1;

    /*Estadiamento */
    document.getElementById("RxPulmonarSelect").selectedIndex = 2;
    document.getElementById("EcoAbdominalSelect").selectedIndex = 1;
    document.getElementById("CintigrafiaSelect").selectedIndex = 3;
    document.getElementById("TACToraxSelect").selectedIndex = 0;
    document.getElementById("TACAbSelect").selectedIndex = 1;
    document.getElementById("TACPelSelect").selectedIndex = 2;

    /*Cirurgia*/
    btnNewCirurgia();
    document.getElementById("data_cirurgia1").value = getDate("2015-08-14");
    document.getElementById("lic1").selectedIndex = 3;
    document.getElementById("checkCirMamaDta1").checked = true;
    FieldsetChange(document.getElementById("checkCirMamaDta1"), 'CirMamaDta1');
    document.getElementById("checkCirMamaEsq1").checked = true;
    FieldsetChange(document.getElementById("checkCirMamaEsq1"), 'CirMamaEsq1');
    document.getElementById("checkCirAxilaDta1").checked = true;
    FieldsetChange(document.getElementById("checkCirAxilaDta1"), 'CirAxilaDta1');
    document.getElementById("checkCirAxilaEsq1").checked = true;
    FieldsetChange(document.getElementById("checkCirAxilaEsq1"), 'CirAxilaEsq1');
    document.getElementById("tecnicaCirSelectMamaDta1").selectedIndex = 2;
    document.getElementById("reconstrucaoCirSelectMamaDta1").selectedIndex = 3;
    document.getElementById("tecnicaCirSelectMamaEsq1").selectedIndex = 1;
    document.getElementById("reconstrucaoCirSelectMamaEsq1").selectedIndex = 1;
    document.getElementById("tecnicaCirSelectAxilaDta1").selectedIndex = 2;
    document.getElementById("tecnicaCirSelectAxilaEsq1").selectedIndex = 1;


    /*Patologia*/
    document.getElementById("tipohistologico").selectedIndex = 2;
    document.getElementById("tamanho_tumor").value = 3;
    document.getElementById("grau").selectedIndex = 3;
    document.getElementById("re_tumor").value = 30;
    document.getElementById("rp_tumor").value = 20;
    document.getElementById("Ki67_tumor").value = 3;
    document.getElementById("her2_tumor").selectedIndex = 1;
    document.getElementById("margem_tumor").selectedIndex = 3;
    document.getElementById("extemporaneoSelect").selectedIndex = 1;
    document.getElementById("extemporaneoNum").value = 3;
    document.getElementById("ea_total").value = 5;
    document.getElementById("ea_invadidos").value = 3;
    document.getElementById("metastases").selectedIndex = 3;
    document.getElementById("estadio").value = "0";

    /*QT/RT/HT */
    document.getElementById("QuimioterapiaSelect").selectedIndex = 1;
    document.getElementById("quimiodatainicio").value = getDate("2015-08-14");
    document.getElementById("quimiodatafim").value = getDate("2015-09-14");
    document.getElementById("RadioterapiaSelect").selectedIndex = 1;
    document.getElementById("radiodatainicio").value = getDate("2015-08-14");
    document.getElementById("radiodatafim").value = getDate("2015-09-14");
    document.getElementById("HormonoterapiaSelect").selectedIndex = 3;
    document.getElementById("hormonodatainicio").value = getDate("2015-08-14");
    document.getElementById("hormonodatafim").value = getDate("2015-09-14");

    /*FollowUP */
    document.getElementById("dataFollowUp").value = getDate("2015-08-14");
    document.getElementById("follow_up").selectedIndex = 1;
    document.getElementById("data_rec").value = getDate("2015-08-14");
    document.getElementById("data_falecimento").value = getDate("2015-08-14");

}