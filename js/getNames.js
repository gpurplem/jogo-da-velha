function autocomplete(inp, arr) { /*input element and array*/
    var currentFocus;

    inp.addEventListener("input", function (e) { /*input activates when user writes*/
        var a, b, i, val = this.value;
        closeAllLists(); /*close any already open lists of autocompleted values*/
        if (!val) { return false; }
        currentFocus = -1;
        a = document.createElement("DIV"); /*create DIV that will contain the items (values)*/
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        this.parentNode.appendChild(a); /*append DIV as a child of the autocomplete container*/

        for (i = 0; i < arr.length; i++) { /*each item in the array*/
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) { /*item starts same letters as field value*/
                b = document.createElement("DIV"); /*create a DIV for each matching element*/
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>"; /*make matching letters bold*/
                b.innerHTML += arr[i].substr(val.length);
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>"; /*insert input field that'll hold the current array item's value*/
                b.addEventListener("click", function (e) { /*when click on the item value (DIV element)*/
                    inp.value = this.getElementsByTagName("input")[0].value; /*insert value autocomplete text field*/
                    closeAllLists();
                });
                a.appendChild(b);
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