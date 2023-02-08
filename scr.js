function  calc(n){    
    if (ost_tic < n) n= ost_tic
    let k1=0
    let s1=0

    let r = Math.floor(Math.random()*all_tikets.size)
    const arr = all_tikets.entries()
    for (let i=0;i<n;i++){
        ticby++;
        let idx = arr.next().value
        wincost+=idx[1]
        k1 = win_list.get(idx[1])
        win_list.set(idx[1], ++k1)
        s1+=idx[1]    
        all_tikets.delete(idx[0])          
    }
ost_tic = all_tikets.size
res_str = s1+' руб.'
if (s1===0) res_str = "Без выигрыша"
if (ost_tic==0) res_str="Билеты кончились!"
summ()
page()
    
}

function page (){

    document.getElementById("i1").innerHTML = res_str.toLocaleString ('ru')
    document.getElementById("ticby").innerHTML = ticby.toLocaleString("ru");
    document.getElementById("cost").innerHTML = (ticby*50).toLocaleString('ru')+ ' руб.';
    document.getElementById("wincost").innerHTML = wincost.toLocaleString('ru')+ ' руб.';
    document.getElementById("sb").innerHTML = sb.toLocaleString('ru') + ' руб.';
    document.getElementById("wintic").innerHTML =  all_tikets.size.toLocaleString('ru')
    document.getElementById("h0").innerHTML = win_list.get(0).toLocaleString('ru');
    document.getElementById("w50").innerHTML = win_list.get(50).toLocaleString('ru');
    document.getElementById("w125").innerHTML = win_list.get(125).toLocaleString('ru');
    document.getElementById("w250").innerHTML = win_list.get(250).toLocaleString('ru');
    document.getElementById("w1250").innerHTML = win_list.get(1250).toLocaleString('ru');
    document.getElementById("w2k5").innerHTML = win_list.get(2500).toLocaleString('ru');
    document.getElementById("w12k5").innerHTML = win_list.get(125000);
    document.getElementById("w1m").innerHTML = win_list.get(1000000);

    if (ticby>50) {
        document.getElementById("bt2").style.display = ""}
    else{
        document.getElementById("bt2").style.display = "None"
    }
    if (ticby>20000){
        document.getElementById("bt3").style.display = ""
    }
    else {
        document.getElementById("bt3").style.display = "None"
    }
}


let res_str = "Удачной игры! Хотя..."
let sb=0
let wincost = 0;
let ticby = 0;
let all_tikets = new Map();
let all_tic = 2000000;
let priz_arr = new Map();
let win_list = new Map();
let ost_tic = all_tic
priz_arr.set(0,0);
priz_arr.set(50,600000);
priz_arr.set(125,48000);
priz_arr.set(250,10000);
priz_arr.set(1250,4000);
priz_arr.set(2500,2000);
priz_arr.set(125000,4);
priz_arr.set(1000000,1);

for (i=0;i<all_tic;i++){
    all_tikets.set(i,0)
}

for (const [key, value] of priz_arr) {
    let k=0
    let ss  = 0
    while (k<value) {
        let bon = Math.floor(Math.random() * all_tic)
        if (all_tikets.get(bon)==0) {
            all_tikets.set(bon, key);
            ss+=key
            k++
        }
    }
    //console.log( key + "   " + ss);
}

for (const [key] of priz_arr){
    win_list.set(key,0)
}

summ()
page()



function summ(){
    sb = 0
    for (const [key, value] of all_tikets)
    {
        if (value > 0) sb+=value
    }
}