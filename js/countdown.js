function getReady(){
    let array = [5,4,3,2,1];
    function timer(){
        array.forEach((element) => {
            console.log(element);
        })
    };  
    timer();
    setInterval(timer, 1000);
}
getReady()
