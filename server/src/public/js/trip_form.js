


let state = [
  {
    id: generateId(),
    title: "",
    paragraph_1: "",
    paragraph_2: "",
    paragraph_3: "",
  },
];

const urlParams = new URLSearchParams(window.location.search);
let id = urlParams.get("id");

fetch(`/admin/get-trip-content?id=${id}`)
.then(res => res.json())
.then((contents) => {
  if (contents.length > 0) {
    contents.forEach((element, index) => {
      state[index] = {
        id: generateId(),
        title: element["title"],
        paragraph_1: element["paragraphs"]["paragraph_1"],
        paragraph_2: element["paragraphs"]["paragraph_2"],
        paragraph_3: element["paragraphs"]["paragraph_3"],
      };
    });
    render();
  }
  
});

render();


function addContentField(event) {
  event.preventDefault();
  state.push({
    id: generateId(),
    title: "",
    paragraph_1: "",
    paragraph_2: "",
    paragraph_3: "",
  });

  render();
}

function setPrevValue(event) {
  let id = event.target.parentElement.getAttribute("data-id");
  let index = state.findIndex((field) => field.id === id);
  let inputName = event.target.getAttribute("id");
  state[index][inputName] = event.target.value;
  console.log(state);
}

function deleteContentField(event) {
  event.preventDefault();
  const id = event.target.parentElement.getAttribute("data-id");
  const index = state.findIndex((field) => field.id === id);
  state.splice(index, 1);
  render();
}


function render() {

  
  let contentTemplate = "";
  state.forEach((field, index) => {
    if (index < 3) {
      contentTemplate += `
          <div id="content-template" data-id=${field.id} class="mb-3 border rounded p-5" style="background:rgba(0, 0, 0, 0.48)">
          <h6 class="mb-4 bg-warning text-light d-flex align-items-center justify-content-center" style="border-radius: 50%; height: 30px; width: 30px;">${ index + 1}.</h6>
          <input type="text"  oninput=setPrevValue(event)  id="title" class="form-control mb-5" name="content[][${index}]" placeholder="Tartalom cím.." value='${field.title ? field.title : ""}' required/>
              <input type="text" required class="form-control mb-3" oninput=setPrevValue(event) id="paragraph_1" rows="3" placeholder="1. paragrafus"  value='${
                field.paragraph_1 ? field.paragraph_1 : ""
              }' name="content[${index}][]" required />
              <input type="text" required class="form-control mb-3" oninput=setPrevValue(event) id="paragraph_2" value='${
                field.paragraph_2 ? field.paragraph_2 : ""
              }' rows="3" placeholder="2. paragrafus" name="content[${index}][]" required />
              <input type="text" required class="form-control mb-3" oninput=setPrevValue(event) id="paragraph_3" value='${
                field.paragraph_3 ? field.paragraph_3 : ""
              }' rows="3" placeholder="3. paragrafus" name="content[${index}][]" required />
              <button class="btn btn-danger" onClick=deleteContentField(event)>Törlés</button>
          </div>
      `;
    }
  });

  const container = document.getElementById("content-container");
  container.innerHTML = contentTemplate;
}


function generateId() {
  return Math.random().toString(16).slice(2);
}
