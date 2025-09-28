document.getElementById('type').addEventListener('change', function() {
    let targetSelect = document.getElementById('target_role');
    if(this.value == 'system-wide'){
        targetSelect.disabled = true;
    } else {
        targetSelect.disabled = false;
    }
});
