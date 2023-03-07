let q = new XMLHttpRequest()

q.open("get", "http://nt32.ru/select.php")
q.send()
q.onload = resp
function resp() {
    //alert(`Готово, получили ${q.response.length} байт`);

    let resp = q.responseText
    console.log(q.statusText)
    console.log(`Готово, получили ${q.response.length} байт`)
    console.log(resp)

}

