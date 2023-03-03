let q = new XMLHttpRequest()
q.open("get", "http://nt32.ru/select.php")
q.send()

q.onload = resp()



function resp() {
    if (q.status != 200) {
        console.log('Ошибка')
        return
    }
    else {
        alert(`Готово, получили ${q.response.length} байт`);
    }
}