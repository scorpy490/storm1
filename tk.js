addEventListener("keydown", kdown);
let k=0, s, t
let step=1
s = ''
let txt
//txt='Привет!\nCофт не должен быть платным'
//document.getElementById('txt1').innerText = txt
let tm1 //Время начала
let tm2 //Время завершения
let err = 0
let sf = ''
let p = document.createElement('h2')
p.style.border = "3px solid blue"
p.style.paddingLeft = "5px"
let exesize = new Map
exesize.set (1, "проверка")
exesize.set (2, "оа вал лов фол фал лафа вы фад фод дылда лод важл алла авдл ожда вфды")
exesize.set (3, "никакой софт не должен быть платным")
exesize.set (4, "бесплатный сыр бывает только в мышеловке")

function start() {
    document.getElementById('resume').innerText = ''
    document.getElementById('title_resume').innerText = ''

    txt = exesize.get(step)    
    s = ''    
    err = 0
    sf = ''
    p.id = "txt1"

    for (let i = 0; i < txt.length; i++) {
        sf += '<span id="' + i + '">' + txt[i] + '</span>'
       // if (txt[i] == '\n') s += '</br>'

    }    
    p.innerHTML = sf
    document.body.prepend(p)
    document.getElementById('bt').style.display="none"
    document.getElementById('bt').disabled=true

}



function  tk1() {
    let pos = s.length
    if (pos===0) tm1 = Date.now()
    if (txt[pos]==k){
        s+=k        
        if (document.getElementById(pos).style.backgroundColor!=="orange")  document.getElementById(pos).style.backgroundColor = "yellow"
    }
    else {
        document.getElementById(pos).style.backgroundColor = "orange"
        err+=1
    }
    if (s.length === txt.length) {
        tm2 = Date.now()
        let delta = Math.floor(tm2-tm1)/1000
        let title_resume = document.getElementById("title_resume")
        if (err <2) {
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
        document.getElementById('bt').style.display=""
        document.getElementById('bt').disabled=false
    }

}




function kdown(e){
   //console.log(e.keyCode)
    if (e.keyCode>30) {
        k = e.key
        tk1()
    }
}


