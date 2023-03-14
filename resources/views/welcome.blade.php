<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Implement ChatGPT</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<div class="p-6 bg-gray-50 border rounded-lg shadow-lg">
  <div id="emoticon-container">
    <div class="flex justify-between items-center w-full">
      <input
        type="text"
        class="p-2 text-lg focus:outline-none bg-transparent"
        value="{{ e('slow burn') }}"
      />
      <div id="loading-container" class="d-none">
        <svg
          fill="none"
          class="h-8 w-8 animate-spin text-orange-600"
          viewBox="0 0 32 32"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            clip-rule="evenodd"
            d="M15.165 8.53a.5.5 0 01-.404.58A7 7 0 1023 16a.5.5 0 011 0 8 8 0 11-9.416-7.874.5.5 0 01.58.404z"
            fill="currentColor"
            fill-rule="evenodd"
          />
        </svg>
      </div>
    </div>
    <div style="margin: 50px 200px ">
      <p id="emoji-display" class="mt-4 text-center w-full text-9xl">🤬</p>
    </div>
  </div>
</div>

<script>    

const emoticonForm = document.querySelector("#emoticon-container");
const userInput = emoticonForm.querySelector('input[type="text"]');
const emojiDisplay = emoticonForm.querySelector("p");
userInput.addEventListener(
  "input",
  debounce((event) => {
    fetchEmoji();
  }, 500)
);

function fetchEmoji() {
  const userInput = emoticonForm.querySelector('input[type="text"]');
  const emojiDisplay = document.getElementById("emoji-display");
  const loadingContainer = document.querySelector("#loading-container");
  loadingContainer.classList.remove("d-none");

  fetch(`/api/emoji?content=${userInput.value}`, {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => response.json())
    .then(({ content }) => {
      emojiDisplay.innerText = content;
      loadingContainer.classList.add("d-none");
    })
    .catch((error) => console.error(error));
}

function debounce(callback, delay) {
  let timeoutId;

  return function () {
    const args = arguments;
    const context = this;

    clearTimeout(timeoutId);

    timeoutId = setTimeout(function () {
      callback.apply(context, args);
    }, delay);
  };
}
</script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

