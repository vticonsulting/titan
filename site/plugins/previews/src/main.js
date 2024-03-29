import TogglePreview       from './components/TogglePreview.vue'
import LocatorPreview      from './components/LocatorPreview.vue'
import ColorPreview        from './components/ColorPreview.vue'
import ColorPalettePreview from './components/ColorPalettePreview.vue'
import StructurePreview    from './components/StructurePreview.vue'
import TagsPreview         from './components/TagsPreview.vue'
import MultiselectPreview  from './components/MultiselectPreview.vue'

import './assets/svg/icons.js'

panel.plugin('sylvainjule/previews', {
  components: {
    'k-toggle-field-preview': TogglePreview,
    'k-locator-field-preview': LocatorPreview,
    'k-color-field-preview': ColorPreview,
    'k-color-palette-field-preview': ColorPalettePreview,
    'k-structure-field-preview': StructurePreview,
    'k-tags-field-preview': TagsPreview,
    'k-multiselect-field-preview': MultiselectPreview,
  }
});