import time
import sys


lyrics = [
    ("\nI try (Im not what) to live in black and white But Im so blue (but Im not what you need", 0.10),
  ("\nI'd like (not what you need) to mean it when I say I'm over you", 0.10),
    ("\nBut that's still not true, true And I'm still so blue (and it's not true)", 0.10),
      ("\nI'm true blue, true blue", 0.10),
        ("\nI'm true blue", 0.10),
]

delays = [1.8, 1.8, 1.1, 6.1,1.1]

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