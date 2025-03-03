const title = document.querySelector(".masthead.news-detail-header h2");
const CHAR_TIME = 50; // Speed of character appearance
let text, index;

if (!title) {
  console.log("Error: Title element not found.");
} else {
  console.log("Title element found:", title);
}

// Apply Baffle effect to h2 for glitch effect
const baffleEffect = baffle(".masthead.news-detail-header h2");
baffleEffect.set({
  characters: '█▓▒░ █▓█',
  speed: 50, // Faster speed for glitchier effect
});
baffleEffect.start();

// Function to reveal text character by character
function addChar() {
  title.textContent = text.substr(0, index++); // Reveal the text up to the current index

  // Continue to the next character if there's more text
  if (index <= text.length) {
    setTimeout(addChar, CHAR_TIME);
  } else {
    console.log("Baffle reveal initiated");
    baffleEffect.reveal(2000); // Reveal Baffle effect after the entire text is shown
  }
}

// Start the animation
function start() {
  if (title) {
    index = 0;
    text = title.textContent.trim();
    title.textContent = ""; // Clear initial text to start reveal
    console.log("Starting animation with text:", text);
    setTimeout(addChar, 25); // Initial delay for suspense
  }
}

start(); // Begin the reveal