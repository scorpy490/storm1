addEventListener("keydown", kdown);
let k=0, s, t
s = ''
let txt = ''
//txt='Привет!\nCофт не должен быть платным'
//document.getElementById('txt1').innerText = txt
let tm1 //Время начала
let tm2 //Время завершения
let err = 0
let sf = ''
let p = document.createElement('h2')

function start() {
    s = ''
    txt = 'Никакой софт не должен быть платным'
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
        let res = ('Задание выпонено! '+ '\nЗнаков: '+ pos + '\nВремя: '+ delta+  " сек.\nОшибок: "+ err+ '\nСкорость: '+ Math.floor(pos/delta*60) + " знаков в минуту")
        document.getElementById('resume').innerText = res
    }

}




function kdown(e){
   //console.log(e.keyCode)
    if (e.keyCode>30) {
        k = e.key
        tk1()
    }
}


