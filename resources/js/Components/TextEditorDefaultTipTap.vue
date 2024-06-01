<template>
  <div class="group__editor" v-if="editor">
    <!-- Grup untuk Text Header -->
    <div class="btn__setup">
      <!-- <button type="button" class="btn btn-secondary btn-sm dropdown-toggle remove-border-radius-right" data-bs-toggle="dropdown" aria-expanded="false">
        Text Header
      </button> -->
      <!-- <ul class="dropdown-menu">
        <li v-for="level in 6" :key="`h${level}`">
          <button class="dropdown-item f-12" type="button" @click="editor.chain().focus().toggleHeading({ level: level }).run()">
            H{{ level }}
          </button>
        </li>
      </ul> -->
      <!-- Grup untuk Text Alignment -->
        <button type="button" class="btn btn-secondary btn-sm" @click="editor.chain().focus().setTextAlign('left').run()"><i class='bx bx-align-left' ></i></button>
        <button type="button" class="btn btn-secondary btn-sm" @click="editor.chain().focus().setTextAlign('center').run()"><i class='bx bx-align-middle' ></i></button>
        <button type="button" class="btn btn-secondary btn-sm" @click="editor.chain().focus().setTextAlign('right').run()"><i class='bx bx-align-right' ></i></button>
        <button type="button" class="btn btn-secondary btn-sm" @click="editor.chain().focus().setTextAlign('justify').run()"><i class='bx bx-align-justify' ></i></button>
      <!-- Tombol untuk Bold, Italic, dan Underline -->
      <button type="button" class="btn btn-secondary btn-sm" @click="editor.chain().focus().toggleBold().run()">
        <i class='bx bx-bold' ></i>
      </button>
      <button type="button" class="btn btn-secondary btn-sm" @click="editor.chain().focus().toggleItalic().run()">
        <i class='bx bx-italic' ></i>
      </button>
      <button type="button" class="btn btn-secondary btn-sm" @click="editor.chain().focus().toggleUnderline().run()">
        <i class='bx bx-underline' ></i>
      </button>
      <!-- Grup untuk Table -->
      <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <i class='bx bx-table' ></i>
      </button>
      <ul class="dropdown-menu">
          <!-- Tombol Insert Table -->
          <li><button type="button" class="dropdown-item f-12" @click="editor.chain().focus().insertTable({ rows: 3, cols: 3, withHeaderRow: true }).run()">Insert Table</button></li>

          <!-- Tombol Add Column Before -->
          <li><button type="button" class="dropdown-item f-12" @click="editor.chain().focus().addColumnBefore().run()" :disabled="!editor.can().addColumnBefore()">Add Column Before</button></li>

          <!-- Tombol Add Column After -->
          <li><button type="button" class="dropdown-item f-12" @click="editor.chain().focus().addColumnAfter().run()" :disabled="!editor.can().addColumnAfter()">Add Column After</button></li>

          <!-- Tombol Delete Column -->
          <li><button type="button" class="dropdown-item f-12" @click="editor.chain().focus().deleteColumn().run()" :disabled="!editor.can().deleteColumn()">Delete Column</button></li>

          <!-- Tombol Add Row Before -->
          <li><button type="button" class="dropdown-item f-12" @click="editor.chain().focus().addRowBefore().run()" :disabled="!editor.can().addRowBefore()">Add Row Before</button></li>

          <!-- Tombol Add Row After -->
          <li><button type="button" class="dropdown-item f-12" @click="editor.chain().focus().addRowAfter().run()" :disabled="!editor.can().addRowAfter()">Add Row After</button></li>

          <!-- Tombol Delete Row -->
          <li><button type="button" class="dropdown-item f-12" @click="editor.chain().focus().deleteRow().run()" :disabled="!editor.can().deleteRow()">Delete Row</button></li>

          <!-- Tombol Delete Table -->
          <li><button type="button" class="dropdown-item f-12" @click="editor.chain().focus().deleteTable().run()" :disabled="!editor.can().deleteTable()">Delete Table</button></li>

          <!-- Tombol Merge Cells -->
          <li><button type="button" class="dropdown-item f-12" @click="editor.chain().focus().mergeCells().run()" :disabled="!editor.can().mergeCells()">Merge Cells</button></li>

          <!-- Tombol Split Cell -->
          <li><button type="button" class="dropdown-item f-12" @click="editor.chain().focus().splitCell().run()" :disabled="!editor.can().splitCell()">Split Cell</button></li>

          <!-- Dan seterusnya untuk semua tombol lainnya sesuai kebutuhanmu -->
      </ul>
      <button type="button" @click="editor.chain().focus().toggleBulletList().run()" :class="{ 'is-active': editor.isActive('bulletList') }">
        <i class='bx bx-list-ul' ></i>
      </button>
      <button type="button" @click="editor.chain().focus().toggleOrderedList().run()" :class="{ 'is-active': editor.isActive('orderedList') }">
        <i class='bx bx-list-ol' ></i>
      </button>
    </div>


    <!-- Editor content -->
    <editor-content class="editor__panel" :editor="editor" />
  </div>
</template>

<script>
import StarterKit from '@tiptap/starter-kit'
import Table from '@tiptap/extension-table'
import TableRow from '@tiptap/extension-table-row'
import TableHeader from '@tiptap/extension-table-header'
import TableCell from '@tiptap/extension-table-cell'
import BulletList from '@tiptap/extension-bullet-list'
import OrderedList from '@tiptap/extension-ordered-list'
import { TextAlign } from '@tiptap/extension-text-align'
import { Underline } from '@tiptap/extension-underline'
import { Placeholder } from '@tiptap/extension-placeholder'
import { Editor, EditorContent } from '@tiptap/vue-3'

export default {
  components: {
    EditorContent,
  },
  emits: ['update:modelValue'],
  props: {
    modelValue: {
      type: String,
      default: '',
    },
  },
  watch: {
    modelValue(value) {
      // HTML
      const isSame = this.editor.getHTML() === value

      // JSON
      // const isSame = JSON.stringify(this.editor.getJSON()) === JSON.stringify(value)

      if (isSame) {
        return
      }

      this.editor.commands.setContent(value, false)
    },
  },
  data() {
    return {
      editor: null,
    }
  },
  mounted() {
    this.editor = new Editor({
      extensions: [
        StarterKit,
        Underline,
        BulletList,
        OrderedList,
        Table.configure({
          resizable: true,
        }),
        TextAlign.configure({
            types: ['heading', 'paragraph'],
        }),
        TableRow,
        TableHeader,
        TableCell,
        Placeholder.configure({
            placeholder: 'Ketikan sesuatu disini...',
        }),
      ],
      content: this.modelValue,
      onUpdate: () => {
        // HTML
        this.$emit('update:modelValue', this.editor.getHTML())

        // JSON
        // this.$emit('update:modelValue', this.editor.getJSON())
      },
    })
  },
}
</script>

<style lang="scss">
.btn__setup {
    display: flex;
    border: 1px solid #ced4da;
    border-radius: 6px;
}
.btn__setup button {
    border-radius: 0px;
    padding: 20px 15px;
    background-color: transparent;
    font-size: 16px;
    color: #000;
    border: 0px solid #ced4da;
    display: flex;
    align-items: center;
    justify-content: center;
}
.btn__setup .dropdown-item {
    padding: 10px 10px;
    justify-content: flex-start;
}
.group__editor {
    display: flex;
    flex-direction: column;
}
.editor__panel {
  margin: 1rem 0;
}
.f-12 {
    font-size: 12px !important;
}
.tiptap {
    padding: 10px;
    min-height: 250px;
    border: 2px solid #ced4da;
    border-radius: 6px;
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
}
.tiptap:active {
  outline: none;
}
.tiptap:focus {
  outline: none;
}

.tiptap > * + * {
  margin-top: 0.75em;
}

.tiptap ul,
.tiptap ol {
  padding: 0 1rem;
}

.tiptap h1,
.tiptap h2,
.tiptap h3,
.tiptap h4,
.tiptap h5,
.tiptap h6 {
  line-height: 1.1;
}

.tiptap code {
  background-color: rgba(97, 97, 97, 0.1);
  color: #616161;
}

.tiptap pre {
  background: #0D0D0D;
  color: #FFF;
  font-family: 'JetBrainsMono', monospace;
  padding: 0.75rem 1rem;
  border-radius: 0.5rem;
}

.tiptap pre code {
  color: inherit;
  padding: 0;
  background: none;
  font-size: 0.8rem;
}

.tiptap img {
  max-width: 100%;
  height: auto;
}

.tiptap blockquote {
  padding-left: 1rem;
  border-left: 2px solid rgba(13, 13, 13, 0.1);
}

.tiptap hr {
  border: none;
  border-top: 2px solid rgba(13, 13, 13, 0.1);
  margin: 2rem 0;
}

.tiptap table {
  border-collapse: collapse;
  table-layout: fixed;
  width: 100%;
  margin: 0;
  overflow: hidden;
}

.tiptap td,
.tiptap th {
  min-width: 1em;
  border: 1px solid #000;
  padding: 3px 5px;
  vertical-align: top;
  box-sizing: border-box;
  position: relative;
}

.tiptap td > *,
.tiptap th > * {
  margin-bottom: 0;
}

.tiptap th {
}

.tiptap .selectedCell:after {
  z-index: 2;
  position: absolute;
  content: "";
  left: 0; right: 0; top: 0; bottom: 0;
  background: rgba(200, 200, 255, 0.4);
  pointer-events: none;
}

.tiptap .column-resize-handle {
  position: absolute;
  right: -2px;
  top: 0;
  bottom: -2px;
  width: 4px;
  background-color: #adf;
  pointer-events: none;
}

.tiptap p {
  margin: 0;
  font-family: 'Arial', sans-serif !important;
}

.tableWrapper {
  overflow-x: auto;
}

.resize-cursor {
  cursor: ew-resize;
  cursor: col-resize;
}
.remove-border-radius-right {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
.tiptap p.is-empty::before {
  color: #adb5bd;
  content: attr(data-placeholder);
  float: left;
  height: 0;
  pointer-events: none;
}
.tiptap {
  > * + * {
    margin-top: 0.75em;
  }

  ul,
  ol {
    padding: 0 1rem;
  }
}
</style>
