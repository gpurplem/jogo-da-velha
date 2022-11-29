function autocomplete(inp, arr) { /*input element and array*/
    var currentFocus;

    inp.addEventListener("input", function (e) { /*input activates when user writes*/
        var newDiv, itemsListDiv, i, val = this.value; /*this = inp, value = content of input box*/
        closeAllLists(); /*close any already open lists of autocompleted values*/
        if (!val) { return false; }
        currentFocus = -1;
        newDiv = document.createElement("DIV"); /*create DIV that will contain the items (values)*/
        newDiv.setAttribute("id", this.id + "autocomplete-list");
        newDiv.setAttribute("class", "autocomplete-items");
        this.parentNode.appendChild(newDiv); /*append DIV as a child of the autocomplete container*/
        for (i = 0; i < arr.length; i++) { /*each item in the array*/
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) { /*val=Abc, val.length=3*/
                itemsListDiv = document.createElement("DIV"); /*create a DIV for each matching element*/
                itemsListDiv.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>"; /*make matching letters bold*/
                itemsListDiv.innerHTML += arr[i].substr(val.length); /*innerHTML = appendChild(object)*/
                itemsListDiv.innerHTML += "<input type='hidden' value='" + arr[i] + "'>"; /*insert input field that'll hold the current array item's value*/
                itemsListDiv.addEventListener("click", function (e) { /*when click on the item value (DIV element)*/
                    inp.value = this.getElementsByTagName("input")[0].value; /*insert value autocomplete text field*/
                    closeAllLists();
                });
                newDiv.appendChild(itemsListDiv);
            }
        }
    });

    inp.addEventListener("keydown", function (e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            currentFocus++; /*If arrow DOWN pressed, increase the currentFocus*/
            addActive(x); /*make the current item more visible*/
        } else if (e.keyCode == 38) { //up
            currentFocus--;
            addActive(x);
        } else if (e.keyCode == 13) {
            e.preventDefault(); /*ENTER key is pressed, prevent form from being submitted*/
            if (currentFocus > -1) {
                if (x) x[currentFocus].click();/*simulate a click on the "active" item:*/
            }
        }
    });

    function addActive(x) { /*classify an item as "active"*/
        if (!x) return false;
        removeActive(x); /*remove the "active" class on all items*/
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) { /*remove "active" class from all autocomplete items*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt) { /*close all lists in document, except one passed as an argument*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }

    document.addEventListener("click", function (e) {  /*closes list when click in the document*/
        closeAllLists(e.target);
    });
}

var namesArray = Array();

var xmlhttp = new XMLHttpRequest();
xmlhttp.onload = function() {
  namesArray = JSON.parse(this.responseText);
}
xmlhttp.open("POST", "../model/getAdversaryNames.php", true);
xmlhttp.send();
                                
autocomplete(document.getElementById("input-adv"), nomes);