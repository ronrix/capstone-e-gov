/* eslint-env node */
require('@rushstack/eslint-patch/modern-module-resolution')

module.exports = {
  root: true,
  'extends': [
    'plugin:vue/recommended',
    'eslint:recommended',
    'prettier',
    // '@vue/eslint-config-prettier/skip-formatting',
  ],
  parserOptions: {
    ecmaVersion: 'latest'
  },
  rules: {
    "vue/multi-word-component-names": "off",
    "vue/no-multiple-template-root": "off",
    "vue/require-default-prop": "off"
  }
}
