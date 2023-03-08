let q = new XMLHttpRequest()

q.open("get", "http://nt32.ru/select.php")
q.send()
q.onload = resp
function resp() {
    //alert(`Готово, получили ${q.response.length} байт`);

    let resp = q.responseText
    let resp_arr = JSON.parse(resp)
    let table = document.getElementById('table')
    let thead = document.createElement("thead");
    let headerRow = thead.insertRow();
    for (const key in resp_arr[0]) {
        let header = document.createElement("th");
        //headerRow.insertCell().innerHTML = key
        header.innerHTML = key
        headerRow.appendChild(header);

        }
    table.appendChild(thead);

    for (const i in resp_arr) {
        const row = table.insertRow()
        for (const key in resp_arr[i]) {
                const cell =  resp_arr[i][key]
                const cur_cell = row.insertCell()
                cur_cell.innerHTML=cell

        }
        //document.write('<br\>')
    }

}

