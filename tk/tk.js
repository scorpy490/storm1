let exesize = new Map
let k = 0, s, t, p
let step = 1
s = ''
let txt
let tm1 //Время начала
let tm2 //Время завершения
let err = 0
let sf = ''
let err_fl = 1 // флаг ошибки

var xhr = new XMLHttpRequest();
xhr.open("POST", "http://nt32.ru/tk/tk.php", true);
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
        console.log(xhr.responseText);
            main (xhr.responseText);
    }
};
//var data = JSON.stringify({select: 'true'});
var data = "select=true";
xhr.send(data);

function main (jsonData) {

    const tabl = JSON.parse(jsonData);
    exesize = new Map (tabl.map(item => [item.id, item.txt]));

    //exesize.set(1, "проверка\nпривет мир")
    //exesize.set(2, "оа вал лов фол фал лафа вы фад фод дылда вода важл алла жало вдова лыжа вожжа")
    //exesize.set(3, "никакой софт не должен быть платным")
    //exesize.set(4, "бесплатный сыр бывает только в мышеловке")
    //exesize.set(0, "Коуч предлагал понимать так: Россия под руководством единственных европейцев всю свою историю занималась совершенно не нужными ее обитателям делами, плоды которых пожинали другие страны и народы. Как деревенский идиот, которого зовут с улицы в приличный дом помахаться в общей драке, а потом снова выставляют на мороз.")


    addEventListener("keydown", kdown);
    p = document.createElement('h2')
    p.style.border = "3px solid blue"
    p.style.paddingLeft = "5px"


    openModal('Тренировка', 'Печатайте текст', start, closeModal)
}

function start() {
    closeModal()
    document.getElementById('resume').innerText = ''
    document.getElementById('title_resume').innerText = ''

    txt = exesize.get(step.toString())
    s = ''    
    err = 0
    sf = ''
    p.id = "txt1"

    for (let i = 0; i < txt.length; i++) {
        sf += '<span id="' + i + '">' + txt[i] + '</span>'
       if (txt[i] === '\n') sf += '</br>'

    }
    p.innerHTML = sf
    document.body.prepend(p)
    //document.getElementById('bt').style.display="none"
    //document.getElementById('bt').disabled=true

}



function  tk1() {
    let pos = s.length
    if (pos===0) tm1 = Date.now()
    if (txt[pos]==='\n') {
        if (k===' ' || k==='Enter') {
            pos+=1
            s+='\n'
            return
        }
        else {
            let old_pos = pos-1
            document.getElementById(old_pos.toString()).style.backgroundColor = "magenta"
            err+=1
            return;
        }
    }
    if (txt[pos]===k){
        s+=k
        if (document.getElementById(pos).style.backgroundColor==="red")  document.getElementById(pos).style.backgroundColor = "orange"
        if (document.getElementById(pos).style.backgroundColor==="")  document.getElementById(pos).style.backgroundColor = "yellow"
        err_fl = 0
    }
    else {
        document.getElementById(pos).style.backgroundColor = "red"
        if (err_fl==0)  {
            err+=1
            err_fl = 1
        }

    }
    if (s.length === txt.length) {
        tm2 = Date.now()
        let delta = Math.floor(tm2-tm1)/1000
        let title_resume = document.getElementById("title_resume")
        if (err <4) {
            step++
            title_resume.style.color = "green"
            title_resume.innerText = "Задание выполнено"
        }
        else {
            title_resume.style.color = "red"
            title_resume.innerText = "Задание не выполнено"
        }
        let res = ('Знаков: '+ pos + '\nВремя: '+ delta+  " сек.\nОшибок: "+ err+ '\nСкорость: '+ Math.floor(pos/delta*60) + " знаков в минуту")
        document.getElementById('resume').innerText = res
        //document.getElementById('bt').style.display=""
        //document.getElementById('bt').disabled=false
        openModal('Набирайте текст', 'Упражнение №' + step, start,closeModal)
    }

}




function kdown(e){
   //console.log(e.keyCode)
    if (e.keyCode>30 || e.keyCode===13) {
        k = e.key
        tk1()
    }
}

function openModal(title, message, confirmHandler, cancelHandler) {
    var modal = document.getElementById("modal");
    var titleElement = document.getElementById("modal-title");
    var messageElement = document.getElementById("modal-message");
    var confirmButton = document.getElementById("modal-confirm");
    var cancelButton = document.getElementById("modal-cancel");
    let randomButton = document.getElementById("modal-random");

    titleElement.textContent = title;
    messageElement.textContent = message;
    confirmButton.onclick = confirmHandler;

    randomButton.onclick = randomEx;

    cancelButton.onclick = cancelHandler;

    modal.style.display = "block";
    confirmButton.focus()
}

function closeModal() {
    const modal = document.getElementById("modal");
    modal.style.display = "none";
}

function randomEx(){
    let rand = Math.floor(Math.random()*exesize.size)
    step = rand
    start()
}



