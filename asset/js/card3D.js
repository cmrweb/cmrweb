const card = document.querySelector('.card3D');
card.innerHTML= card.innerHTML+`<div id="topright"></div>
<div id="top"></div>
<div id="topleft"></div>
<div id="bottomright"></div>
<div id="bottom"></div>
<div id="bottomleft"></div>`;
function card3D(id) {

    // element = [
    //     card.querySelector("#top"),
    //     card.querySelector("#bottom"),
    //     card.querySelector("#topright"),
    //     card.querySelector("#topleft"),
    //     card.querySelector("#bottomright"),
    //     card.querySelector("#bottomleft")
    // ];
    // for (let i = 0; i < element.length; i++) {
    //     console.log(element[i])
    // }

    let transform, shadow,textShadow;
    switch (id) {
        case "top":
            transform = "rotate3d(-77, -2, 0, 45deg)";
            shadow = "#78787859 2px 15px 3px";
            textShadow = "#b8b3b3 2px 7px 3px";
            break;
        case "bottom":
            transform = "rotate3d(0, 0, 0, 45deg)";
            shadow = "#78787859 2px 2px 3px";
            textShadow = "#b8b3b3 2px 2px 3px";
            break;
        case "topright":
            transform = "rotate3d(-9, -38, 2, 45deg)";
            shadow = "#78787859 -15px 10px 3px";
            textShadow = "#b8b3b3 -7px 5px 3px";
            break;
        case "topleft":
            transform = "rotate3d(-9, 22, 2, 45deg)";
            shadow = "#78787859 15px 10px 3px";
            textShadow = "#b8b3b3 7px 5px 3px";
            break;
        case "bottomright":
            transform = "rotate3d(-7, 60, 0, -45deg)";
            shadow = "#78787859 -15px -10px 3px";
            textShadow = "#b8b3b3 -7px -5px 3px";
            break;
        case "bottomleft":
            transform = "rotate3d(7, 15, 0, 45deg)";
            shadow = "#78787859 15px -10px 3px";
            textShadow = "#b8b3b3 7px -5px 3px";
            break;
        default:
            break;
    }
    document.getElementById(id).addEventListener("mouseover", e => {
        card.style.transform = transform;
        card.style.boxShadow = shadow;
        card.style.textShadow = textShadow;
    })
}
card3D("top");
card3D("bottom");
card3D("topright");
card3D("topleft");
card3D("bottomright");
card3D("bottomleft");