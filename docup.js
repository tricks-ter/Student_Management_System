const uploadArea = document.getElementById("uploadArea");
const fileInput = document.getElementById("fileInput");
const fileList = document.getElementById("fileList");
const commentBox = document.getElementById("commentBox");

let versionCount = {};

uploadArea.addEventListener("click", () => fileInput.click());

uploadArea.addEventListener("dragover", (e) => {
  e.preventDefault();
  uploadArea.classList.add("dragover");
});

uploadArea.addEventListener("dragleave", () => {
  uploadArea.classList.remove("dragover");
});

uploadArea.addEventListener("drop", (e) => {
  e.preventDefault();
  uploadArea.classList.remove("dragover");
  const files = e.dataTransfer.files;
  handleFiles(files);
});

fileInput.addEventListener("change", () => {
  handleFiles(fileInput.files);
});

function submitFiles() {
  const files = fileInput.files;
  if (!files.length) {
    alert("Please choose at least one file.");
    return;
  }

  handleFiles(files);
  fileInput.value = "";
  commentBox.value = "";
}

function handleFiles(files) {
  Array.from(files).forEach((file) => {
    const name = file.name;
    versionCount[name] = (versionCount[name] || 0) + 1;

    const fileEntry = document.createElement("div");
    fileEntry.className = "file-entry";
    fileEntry.innerHTML = `
      <strong>${name}</strong><br/>
      Comment: ${commentBox.value || "(No comment)"}<br/>
      <span class="plagiarism">Turnitin Check: ${mockPlagiarismResult()}</span><br/>
      <span class="version">Version: ${versionCount[name]}</span>
    `;
    fileList.appendChild(fileEntry);
  });
}

function mockPlagiarismResult() {
  const results = ["0% Plagiarism", "5% Plagiarism", "20% Plagiarism", "50% Plagiarism"];
  return results[Math.floor(Math.random() * results.length)];
}