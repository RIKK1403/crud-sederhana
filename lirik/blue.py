import time
import sys


lyrics = [
    ("\nYour morning eyes, I could stare like watching stars", 0.13),
  ("\nI could walk you by... and I'll tell without a thought", 0.12),
    ("\nYou'd be mine.... would you mind if I took your hand tonight?", 0.11),
      ("\nKnow you're all that I want... in this life", 0.12),
]

delays = [1.5, 1.2, 1.2, 6.1,]

def animate_text(text, char_delay):
    for char in text:
        sys.stdout.write(char)
        sys.stdout.flush()
        time.sleep(char_delay)
    sys.stdout.write('\n')
    sys.stdout.flush()

def main():
    for i, (text, char_delay) in enumerate(lyrics):
        animate_text(text, char_delay)
        if i < len(lyrics) - 1:
            # Calculate the time until the next line should start
            next_line_delay = max(0, delays[i] - len(text) * char_delay)
            time.sleep(next_line_delay)

if __name__ == "__main__":
    main()