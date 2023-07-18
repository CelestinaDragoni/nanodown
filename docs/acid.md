# Nanodown Acid Test

---

# Header 1 _italic_ *italic* __bold__ **bold** ___bold italic___ ***bold italic***
## Header 2 ~~strike~~ ==highlight== `code`
### Header 3 ~subscript~
#### Header 4 ^superscript^
##### Header 5

---

> # Header 1 _italic_ *italic* __bold__ **bold** ___bold italic___ ***bold italic***
> ## Header 2 ~~strike~~ ==highlight== `code`
> ### Header 3 ~subscript~
> #### Header 4 ^superscript^
> ##### Header 5

---

## Escape

Star: \*

Underscore: \_

Curly Braces Open: \{

Curly Braces Close: \}

Bracket Open: \[

Bracket Close: \]

Parentheses Open: \)

Parentheses Close: \)

Number: \#

Tilde: \~

Backtick: \`

Pipe: \|

Caret: \^

Dash: \-

Plus: \+

Colon: \:

---

## Formatting

Italic Using \*: *Italic Text*

Strong Using \*\*: **Strong Text**

Strong Italic Using \*\*\*: ***Strong/Italic Text***

Italic Using \_: _Italic Text_

Strong Using \_\_: __Strong Text__

Strong Italic Using \_\_\_: ___Strong/Italic Text___

Code Using \`: `sudo vim /etc/hosts`

Code With Escape Characters (Non-Escaped): `void __main__(int argc, char* argv[], char* test[])`

Stikethru Using \~\~: ~~No sir, don't like it.~~

Highlight Using \=\=: ==It's better than bad, it's good!==

Subscript Using \~: H~2~O

Superscript Using \^: a^2^ + b^2^ = c^2^

Links Using \[\]\(\): [Linux Kernel](http://kernel.org)

Links With Escape Characters: [Linux__Kernel__](http://kernel.org/**test**)

Links Using <>: <https://kernel.org>

Links No Formatting: https://kernel.org

Links Using \[\]\(\): [Linux Kernel](http://kernel.org)

---

## Images
![Acid Image](image.png)

## Paragraphs

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut felis laoreet, sodales odio lacinia, efficitur dui. Nulla mattis, metus sit amet feugiat eleifend, arcu turpis gravida quam, a euismod magna sapien eget tortor. Phasellus nec tellus pulvinar, tincidunt arcu et, sollicitudin mi. Integer in porta diam. Nam arcu dui, vestibulum a mauris ac, pulvinar semper mi. Nulla ornare aliquet ligula, mollis dictum neque mattis sit amet. Mauris ut [tincidunt odio](https://kernel.org). Integer a posuere arcu. Cras dapibus volutpat convallis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas vestibulum ipsum vel urna faucibus accumsan. Nulla facilisi.

Lorem ipsum dolor sit amet, *consectetur adipiscing elit*. Aliquam ut felis **laoreet**, sodales odio lacinia, efficitur dui. Nulla mattis, metus sit amet feugiat eleifend, arcu turpis gravida quam, a euismod magna sapien eget tortor. ~~Phasellus~~ nec ==tellus== pulvinar, tincidunt arcu et, sollicitudin mi. Integer in porta diam. Nam arcu dui, vestibulum a mauris ac, pulvinar ***semper mi***. Nulla ornare aliquet ligula, mollis dictum neque mattis sit amet. _Mauris_ ut tincidunt odio. `Integer a posuere arcu`. Cras dapibus volutpat convallis. Class aptent taciti __sociosqu__ ad litora torquent ___per conubia nostra___, per inceptos himenaeos. Maecenas vestibulum ipsum vel urna faucibus accumsan. Nulla facilisi.

> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ut felis laoreet, sodales odio lacinia, efficitur dui. Nulla mattis, metus sit amet feugiat eleifend, arcu turpis gravida quam, a euismod magna sapien eget tortor. Phasellus nec tellus pulvinar, tincidunt arcu et, sollicitudin mi. Integer in porta diam. Nam arcu dui, vestibulum a mauris ac, pulvinar semper mi. Nulla ornare aliquet ligula, mollis dictum neque mattis sit amet. Mauris ut [tincidunt odio](https://kernel.org). Integer a posuere arcu. Cras dapibus volutpat convallis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas vestibulum ipsum vel urna faucibus accumsan. Nulla facilisi.
>
> Lorem ipsum dolor sit amet, *consectetur adipiscing elit*. Aliquam ut felis **laoreet**, sodales odio lacinia, efficitur dui. Nulla mattis, metus sit amet feugiat eleifend, arcu turpis gravida quam, a euismod magna sapien eget tortor. ~~Phasellus~~ nec ==tellus== pulvinar, tincidunt arcu et, sollicitudin mi. Integer in porta diam. Nam arcu dui, vestibulum a mauris ac, pulvinar ***semper mi***. Nulla ornare aliquet ligula, mollis dictum neque mattis sit amet. _Mauris_ ut tincidunt odio. `Integer a posuere arcu`. Cras dapibus volutpat convallis. Class aptent taciti __sociosqu__ ad litora torquent ___per conubia nostra___, per inceptos himenaeos. Maecenas vestibulum ipsum vel urna faucibus accumsan. Nulla facilisi.


## Lists

### Using \-
- Element (0:0)
- Element (0:1)
    - *Element* (1:0)
        - **Element** (2:0)
- Element (0:2)

### Using \+
+ Element (0:0)
+ Element (0:1)
    + ==Element== (1:0)
        + ~~Element~~ (2:0)
+ Element (0:2)

### Using \*
* Element (0:0)
* Element (0:1)
    * `Element` (1:0)
        * ***Element*** (2:0)
    * `Element` (1:1)
* Element (0:3)

### Using Mixed \-\+\*
* Element (0:0)
* Element (0:1)
    * _Element_ (1:0)
        * __Element__ (2:0)

### Numeric
1. ___Element___ (0:0)
2. Element (0:1)
    3. ~Element~ (1:0)
        4. ^Element^ (2:0)
5. Element (0:3)

### Numeric Mixed
1. Element (0:0)
2. Element (0:1)
    * Element (1:0)
        - Element (2:0)
        + Element (2:1)

### Uneven Spacing
- Element (0:0)
 - Element (1:0)
  1. *Element* (2:0)
     22. **Element** (2:1)
- Element (0:1)
 - Element (1:1)


## Lists w/ Blockquote
> ### Using \-
> - Element (0:0)
> - Element (0:1)
>     - *Element* (1:0)
>         - **Element** (2:0)
> - Element (0:2)
>
> ### Using \+
> + Element (0:0)
> + Element (0:1)
>     + ==Element== (1:0)
>         + ~~Element~~ (2:0)
> + Element (0:2)
>
> ### Using \*
> * Element (0:0)
> * Element (0:1)
>     * `Element` (1:0)
>         * ***Element*** (2:0)
> * Element (0:3)
>
> ### Using Mixed \-\+\*
> * Element (0:0)
> * Element (0:1)
>     * _Element_ (1:0)
>         * __Element__ (2:0)
>
> ### Numeric
> 1. ___Element___ (0:0)
> 2. Element (0:1)
>     3. ~Element~ (1:0)
>         4. ^Element^ (2:0)
> 5. Element (0:3)
>
> ### Numeric Mixed
> 1. Element (0:0)
> 2. Element (0:1)
>     * Element (1:0)
>         - Element (2:0)
>         + Element (2:1)
>
> ### Uneven Spacing
> - Element (0:0)
>  - Element (1:0)
>   1. *Element* (2:0)
>      22. **Element** (2:1)
> - Element (0:1)
>  - Element (1:1)

## Codeblocks

```
int main(int argc, char *argv[])
{
    @autoreleasepool {
        return UIApplicationMain(argc, argv, nil, NSStringFromClass([AppDelegate class]));
    }
}
```

> ```
> int main(int argc, char *argv[])
> {
>     @autoreleasepool {
>         return UIApplicationMain(argc, argv, nil, NSStringFromClass([AppDelegate class]));
>     }
> }
> ```

## Tables
|Type| Test0 | *Test1* | **Test3** | ***Test4*** |
|-|-|-|-|-|
|Full Row|Test 0 Contents|Test 1 ~~Contents~~|Test 2 ==Contents==|Test 3 `Contents`|
|Full Row NO Trailing Pipe|Test 0 Contents|Test 1 Contents|Test 2 Contents|Test 3 Contents
|Partial Row Trailing Pipe|Test 0 Contents|Test 1 _Contents_|
|Partial Row NO Trailing Pipe|Test 0 Contents|Test 1 __Contents__
|Partial Row NO Trailing Pipe|Test 0 ___Contents___

> |Type| Test0 | *Test1* | **Test3** | ***Test4*** |
> |-|-|-|-|-|
> |Full Row|Test 0 Contents|Test 1 ~~Contents~~|Test 2 ==Contents==|Test 3 `Contents`|
> |Full Row NO Trailing Pipe|Test 0 Contents|Test 1 Contents|Test 2 Contents|Test 3 Contents
> |Partial Row Trailing Pipe|Test 0 Contents|Test 1 _Contents_|
> |Partial Row NO Trailing Pipe|Test 0 Contents|Test 1 __Contents__
> |Partial Row NO Trailing Pipe|Test 0 ___Contents___

## Definition Lists
**DESCRIPTION**
: grep  searches  for  PATTERNS  in  each  FILE.  PATTERNS is one or patterns separated by newline characters,  and  grep  prints  each line that matches a pattern.
: A  FILE  of  “-”  stands for standard input.  If no FILE is given, recursive searches examine the working directory, and nonrecursive searches read standard input.
: In  addition, the variant programs egrep and fgrep are the same as grep -E and grep -F, respectively.  These variants are deprecated, but are provided for backward compatibility.

## HTML Code Injection (No `^^^^^`)
<div style='background: blue; color: white;'>Oh, hi Danny...</div>

## HTML Code Injection (Using `^^^^^` Wapper)
^^^^^
<div style='background: red; color: white;'>Oh hi Mark...</div>
^^^^^
