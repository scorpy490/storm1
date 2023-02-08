addEventListener("keydown", kdown);
let k, s, t
s=''
txt='Никакой софт не должен быть платным'
//txt='Привет!\nCофт не должен быть платным'
//document.getElementById('txt1').innerText = txt
let tm1
let tm2
let err = 0
let sf=''

let p = document.createElement ('h2')

p.id = "txt1"

for (i=0;i<txt.length;i++){
    sf+='<span id="' + i+ '">' + txt[i] + '</span>'
    if (txt[i]=='\n') s+='</br>'

}
p.innerHTML = sf
document.body.prepend (p)




function  tk1() {
    let pos = s.length
    if (pos===0) tm1 = Date.now()
    if (txt[pos]==k){
        s+=k
        if (document.getElementById(pos).style.backgroundColor!=='Orange')  document.getElementById(pos).style.backgroundColor = "Yellow"
    }
    else {
        document.getElementById(pos).style.backgroundColor = "Orange"
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


