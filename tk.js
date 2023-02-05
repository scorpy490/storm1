addEventListener("keydown", tk);
let k, s, t
s=''
txt='Никакой софт не должен быть платным'
document.getElementById('txt').innerText = txt
let tm1
let tm2
let err = 0

function  tk1() {
    let pos = s.length
    if (pos===0) tm1 = Date.now()
    if (txt[pos]==k){
        s+=k
        document.getElementById('tk').innerText = s
    }
    else {
        err+=1
    }
    if (s.length === txt.length) {
        tm2 = Date.now()
        let delta = Math.floor(tm2-tm1)/1000
        let res = ('Задание выпонено! '+ '\nЗнаков: '+ pos + '\nВремя: '+ delta+  " сек.\nОшибок: "+ err+ '\nСкорость: '+ Math.floor(pos/delta*60) + " знаков в минуту")
        document.getElementById('resume').innerText = res
    }

}




function tk(e){
   //console.log(e.keyCode)
    if (e.keyCode>30) {
        k = e.key
        tk1()
    }
}


