<script setup>
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import SuggestionCard from './Suggestions/SuggestionCard.vue'

import { marked } from 'marked'
import DOMPurify from 'dompurify'
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { headlines } from '../../../assets/data/news'
import moment from 'moment'

const description = ref(`
### Marked - Markdown Parser

[Marked] lets you convert [Markdown] into HTML.  Markdown is a simple text format whose goal is to be very easy to read and write, even when not converted to HTML.  This demo page will let you type anything you like and see how it gets converted.  Live.  No more waiting around.

#### How To Use The Demo

1. Type in stuff on the left.
2. See the live updates on the right.

That's it.  Pretty simple.  There's also a drop-down option above to switch between various views:

- **Preview:**  A live display of the generated HTML as it would render in a browser.
- **HTML Source:**  The generated HTML before your browser makes it pretty.
- **Lexer Data:**  What [marked] uses internally, in case you like gory stuff like this.
- **Quick Reference:**  A brief run-down of how to format things using markdown.

### Why Markdown?

It's easy.  It's not overly bloated, unlike HTML.  Also, as the creator of [markdown] says,

> The overriding design goal for Markdown's
> formatting syntax is to make it as readable
> as possible. The idea is that a
> Markdown-formatted document should be
> publishable as-is, as plain text, without
> looking like it's been marked up with tags
> or formatting instructions.

Ready to start writing?  Either start changing stuff on the left or
[clear everything](/demo/?text=) with a simple click.

[Marked]: https://github.com/markedjs/marked/
[Markdown]: http://daringfireball.net/projects/markdown/
`)

// sanitazing the markdown html strings so that it can render correctly in the DOM
const desc = ref(DOMPurify.sanitize(marked.parse(description.value)))
const useCustomStyles = ref(true) // Set to true if you want to apply custom styles, false otherwise

// paremeter :title
const route = useRoute()
const news = ref()
onMounted(() => {
  const newsTitle = route.params.title
  news.value = headlines.find((el) => el.title === newsTitle)
  console.log(news.value)
})
</script>
<template>
  <!-- add tab title -->
  <head>
    <title>News | Pililla Rizal</title>
  </head>
  <HeaderSection />

  <WrapperContainer>
    <div class="mt-10 flex flex-col md:flex-row gap-5">
      <div class="flex flex-col gap-3 items-start flex-[3]">
        <p class="flex items-center text-xs text-secondary">
          <i class="uil uil-clock-five"></i>
          <span>{{ moment().endOf('day').fromNow() }}</span>
        </p>
        <h3 class="font-bold text-2xl text-dark dark:text-bggray w-1/2">{{ news?.title }}</h3>

        <img class="w-full" :src="news?.thumbnail" alt="" />

        <div
          class=":text-dark dark:text-secondary text-justify leading-loose"
          :class="{ markdown: useCustomStyles }"
          :innerHTML="desc"
        ></div>
      </div>

      <!-- suggestions -->
      <div class="flex-1">
        <h4 class="font-bold text-sm text-dark dark:text-bggray mb-5">Suggestions</h4>
        <SuggestionCard v-for="a in headlines.slice(0, 3)" :key="a.id" :news="a" />
      </div>
    </div>
  </WrapperContainer>
  <FooterSection />
</template>

<style>
.markdown h3 {
  font-size: 1.5em;
  margin-top: 0.5em;
  font-weight: bold;
}
</style>