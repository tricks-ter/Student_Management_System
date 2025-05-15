let isEditable = false;

function toggleEdit() {
  const form = document.getElementById("profileForm");
  const inputs = form.getElementsByTagName("input"); 
  const buttons = form.getElementsByClassName("edit-btn"); 
  const button = buttons[0]; 
  if (!isEditable) {
    for (let i = 0; i < inputs.length; i++) {
      inputs[i].removeAttribute("readonly");
    }
    button.textContent = "Save";
    isEditable = true;
  } else {
    for (let i = 0; i < inputs.length; i++) {
      inputs[i].setAttribute("readonly", true);
    }
    button.textContent = "Edit";
    isEditable = false;

    const data = {
      studentId: inputs[0].value,
      email: inputs[1].value,
      phone: inputs[2].value,
      address: inputs[3].value,
    };
    console.log("Saved Data:", data);
  }
}