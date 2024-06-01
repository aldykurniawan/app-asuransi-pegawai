<template>
  <div>
    <QuillEditor
      ref="quillEditor"
      :options="editorOption"
      :content="modelValue"
      :style="{ height: height }"
      class="quillEditor"
      contentType="html"
      @update:content="textChange"
    />
  </div>
</template>

<script>
  import { defineComponent } from 'vue';
  import { QuillEditor, Quill } from '@vueup/vue-quill';
  import '@vueup/vue-quill/dist/vue-quill.snow.css';
  import ImageUploader from 'quill-image-uploader';
  import Swal from 'sweetalert2';
  // import imageResize from 'quill-image-resize-module';

  import 'quill-image-resize-module/image-resize.min.js';

  // import QuillBetterTable from 'quill-better-table'; // 需要升级 quill 版本 2.0 以上
  // import "quill-better-table/dist/quill-better-table.css";
  Quill.register('modules/ImageUploader', ImageUploader);
  // Quill.register({'modules/better-table': QuillBetterTable}, true)

  // 工具栏配置项
  const toolbarOptions = [
    // 加粗 斜体 下划线 删除线 -----['bold', 'italic', 'underline', 'strike']
    ['bold', 'italic', 'underline', 'strike'],
    // 引用  代码块-----['blockquote', 'code-block']
    ['blockquote', 'code-block'],
    // 1、2 级标题-----[{ header: 1 }, { header: 2 }]
    [{ header: 1 }, { header: 2 }],
    // 有序、无序列表-----[{ list: 'ordered' }, { list: 'bullet' }]
    [{ list: 'ordered' }, { list: 'bullet' }],
    // 上标/下标-----[{ script: 'sub' }, { script: 'super' }]
    [{ script: 'sub' }, { script: 'super' }],
    // 缩进-----[{ indent: '-1' }, { indent: '+1' }]
    [{ indent: '-1' }, { indent: '+1' }],
    // 文本方向-----[{'direction': 'rtl'}]
    [{ direction: 'rtl' }],
    // 字体大小-----[{ size: ['small', false, 'large', 'huge'] }]
    [{ size: ['small', false, 'large', 'huge'] }],
    // 标题-----[{ header: [1, 2, 3, 4, 5, 6, false] }]
    [{ header: [1, 2, 3, 4, 5, 6, false] }],
    // 字体颜色、字体背景颜色-----[{ color: [] }, { background: [] }]
    [{ color: [] }, { background: [] }],
    // 字体种类-----[{ font: [] }]
    [{ font: [] }],
    // 对齐方式-----[{ align: [] }]
    [{ align: [] }],
    // 清除文本格式-----['clean']
    ['clean'],
    // 链接、图片、视频-----['link', 'image', 'video']
    ['link', 'image', 'video'],
    // ['table'] // 表格
  ];

  export default defineComponent({
    name: 'QuillRichtext',
    components: {
      QuillEditor,
    },
    props: {
        modelValue: {
            type: String,
            required: '',
        },
        height: {
            type: String,
            default: '350px',
        },
        triggerChange : {
            type: Function,
            required: () => {},
        },
        idData: {
            type: Number,
            default: null,
        },
        modelData: {
            type: String,
            default: null,
        },
        folderModel: {
            type: String,
            default: 'EPortal',
        },
    },
    watch: {

    },
    data() {
      return {
        myContent: '',
        editorOption: {
          modules: {
            toolbar: toolbarOptions,
            history: {
              delay: 1000,
              maxStack: 50,
              userOnly: false,
            },
            imageResize: {
              displayStyles: {
                backgroundColor: 'black',
                border: 'none',
                color: 'white',
              },
              modules: ['Resize', 'DisplaySize'],
            },
            ImageUploader: {
                upload: file => {
                    return new Promise((resolve, reject) => {
                        Swal.fire({
                            title: 'Mengunggah gambar...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        setTimeout(() => {
                            // check file if not image
                            if (!file.type.match('image.*')) {
                                reject('File is not an image');
                                // toast error
                                Swal.close();
                                toast('error', 'File harus berupa gambar!');
                                return;
                            }

                            const formData = new FormData();
                            formData.append("file", file);
                            formData.append("model", this.modelData);
                            formData.append("foldermodel", this.folderModel);
                            formData.append("idData", this.idData);

                            axios.post(route('master.store-image-app'), formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            })
                            .then(res => {
                                console.log(res)
                                resolve(res.data.url);
                                Swal.close();
                            })
                            .catch(err => {
                                reject("Upload failed");
                                console.error("Error:", err)
                                Swal.close();
                            })
                        }, 1000);
                    })
                }
            }
            // table: false,  // disable table module
            // 'better-table': {
            //   operationMenu: {
            //     items: {
            //       insertColumnRight: { text: '右边插入一列' },
            //       insertColumnLeft: { text: '左边插入一列' },
            //       insertRowUp: { text: '上边插入一行' },
            //       insertRowDown: { text: '下边插入一行' },
            //       mergeCells: { text: '合并单元格' },
            //       unmergeCells: { text: '拆分单元格' },
            //       deleteColumn: { text: '删除列' },
            //       deleteRow: { text: '删除行' },
            //       deleteTable: { text: '删除表格' },
            //     },
            //     background: {
            //       color: '#333'
            //     },
            //     color: {
            //       colors: ['green', 'red', 'yellow', 'blue', 'white'],
            //       text: 'background:'
            //     }
            //   }
            // },
            // keyboard: {
            //   bindings: QuillBetterTable.keyboardBindings
            // }
          },
          theme: 'snow',
          placeholder: 'Ketik sesuatu disini ...',
          // Some Quill optiosn...
        },
      };
    },
    methods: {
      textChange(val) {
        // console.log(val)
        // triggerChange
        this.triggerChange(val);
      }
    }
  });
</script>

<style lang="less"></style>
