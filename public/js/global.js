function dropdownFunction(element,class_name) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    let list = element.parentElement.parentElement.getElementsByClassName("dropdown-content")[0];

    for (i = 0; i < dropdowns.length; i++) {
        dropdowns[i].classList.add("hidden");
    }
    if(list){ 
        list.classList.toggle("hidden");
    }
}

window.onclick = function (event) {
    if (!event.target.matches(".dropbtn")) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            openDropdown.classList.add("hidden");
        }
    }
};

// Function to pull modals into current view and load with data.
function bladeTableHandler(val,blade,table,pass_through){    
    if(val) {
        if(pass_through){
            $.ajax({
                url: blade+'?page='+pass_through,
                success: function (data) {
                    $(document.querySelector('#'+table)).empty();
                    $(document.querySelector('#'+table)).append(data);
                },
                dataType: 'html'
            });
        }else{
            $.ajax({
                url: blade,
                success: function (data) {
                    $(document.querySelector('#'+table)).empty();
                    $(document.querySelector('#'+table)).append(data);
                },
                dataType: 'html'
            });
        }
    }
}

// Function to pull modals into current view and load with data.
function bladeModalHandler(val,blade,modal,pass_through){
    if(val) {
        if(pass_through){
            $.ajax({
                url: blade+'/'+pass_through,
                success: function (data) {
                    $('body').append(data);
                    modalHandler(true,document.querySelector('#'+modal));
                    window.livewire.rescan();
                },
                dataType: 'html'
            });
        }else{
            $.ajax({
                url: blade,
                success: function (data) {
                    $('body').append(data);
                    modalHandler(true,document.querySelector('#'+modal));
                    window.livewire.rescan();
                },
                dataType: 'html'
            });
        }
    }else{
        modalHandler(false,document.querySelector('#'+modal));
        document.querySelector('#'+modal).remove();
    }
}

// Modal handler
function modalHandler(val, modal) {
    if (val) {
        fadeIn(modal);
    } else {
        fadeOut(modal);
    }
}

// Fade out modal
function fadeOut(el) {
    el.style.opacity = 1;
    (function fade() {
        if ((el.style.opacity -= 0.1) < 0) {
            el.style.display = "none";
        } else {
            requestAnimationFrame(fade);
        }
    })();
    // Clear Modals Content
    $('p',el).remove();
    $(':input',el)
    .not(':button, :submit, :reset, :hidden')
    .val('')
    .prop('checked', false)
    .prop('selected', false);
}
// Fade in modal
function fadeIn(el, display) {
    el.style.opacity = 0;
    el.style.display = display || "block";
    (function fade() {
        let val = parseFloat(el.style.opacity);
        if (!((val += 0.2) > 1)) {
            el.style.opacity = val;
            requestAnimationFrame(fade);
        }
    })();
} 

// Handler alerts, allow rapid calling of alert based of passed parameters
function alertHandler(val, alert, display){
    if(display)
        $.ajax({
            url: alert,
            success: function (data) {
                data = data.replace('**ALERT_MESSAGE**',val)
                $('#alert_node').append(data);
                // Wait .05 miliseconds to ensure sweeping animation plays
                setTimeout(function () {
                    document.querySelector('#'+alert).style.transform = "translateY(200%)";
                }, 50);
                // Wait 5 seconds to auto clear, assign set timeout to variable so this timeout can be cancel if dismiss is pressed. 
                clear_alert = setTimeout(function () {
                    alertHandler(null,alert,false );
                }, 5000);
            },
            dataType: 'html'
        });
    else{
        // Cancel auto clearing of alert.
        clearTimeout(clear_alert);
        // Clear alert
        document.querySelector('#'+alert).style.transform = "translateY(-200%)";
        setTimeout(function () {
            $('#alert_node').empty()
        }, 100);
    }
}

function update_element_styling(element, styles, toggle_type){
    if(toggle_type == true | toggle_type == false){
        if(toggle_type == true){
            if(!$("#"+element).hasClass(styles)){
                $("#"+element).addClass(styles);
            }
        }else{
            if($("#"+element).hasClass(styles)){
                $("#"+element).removeClass(styles);
            }
        }
    }else{
        $("#"+element).toggleClass(styles);
    }
    
}

function saveQuestion(question, answers){
    window.livewire.emit('add-new-question',question,answers);
}

function saveEditedQuestion(question, answers, question_id){
    window.livewire.emit('edit-question',question,answers,question_id);
}

function saveAnswer(answer, correct){
    window.livewire.emit('add-new-answer',answer,correct);
}

function saveEditedAnswer(answer, correct, answer_id){
    window.livewire.emit('edit-answer',answer,correct,answer_id);
}

// Function to pull modals into current view and load with data.
function editQuestion(val,blade,modal,question,answers,question_id){
    if(val) {
        $.ajax({
            url: blade+'/',
            data:{
                question:question,
                answers:answers,
                question_id:question_id,
            },
            success: function (data) {
                $('body').append(data);
                modalHandler(true,document.querySelector('#'+modal));
                window.livewire.rescan();
            },
            dataType: 'html'
        });
    }else{
        modalHandler(false,document.querySelector('#'+modal));
        document.querySelector('#'+modal).remove();
    }
}

// Function to pull modals into current view and load with data.
function editAnswer(val,blade,modal,answer,correct,answer_id){
    if(val) {
        $.ajax({
            url: blade+'/',
            data:{
                answer:answer,
                correct:correct,
                answer_id:answer_id,
            },
            success: function (data) {
                $('body').append(data);
                modalHandler(true,document.querySelector('#'+modal));
                window.livewire.rescan();
            },
            dataType: 'html'
        });
    }else{
        modalHandler(false,document.querySelector('#'+modal));
        document.querySelector('#'+modal).remove();
    }
}