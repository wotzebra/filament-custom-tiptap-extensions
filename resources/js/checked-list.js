import { Node, mergeAttributes } from '@tiptap/core'

const CheckedList = Node.create({
  name: 'checkedList',

  group: 'block list',

  content: 'listItem+',

  parseHTML() {
    return [
      {
        tag: 'ul',
        getAttrs: (node) => node.classList.contains('checked-list') && null,
      },
    ]
  },

  renderHTML({ HTMLAttributes }) {
    return ['ul', mergeAttributes(HTMLAttributes, { class: 'checked-list' }), 0]
  },

  addCommands() {
    return {
      toggleCheckedList:
        () =>
          ({ commands }) => {
            return commands.toggleList(this.name, 'listItem')
          },
    }
  },

  addKeyboardShortcuts() {
    return {
      'Mod-Shift-9': () => this.editor.commands.toggleCheckedList(),
    }
  },
})

export default CheckedList
