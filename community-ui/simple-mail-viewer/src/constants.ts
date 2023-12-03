export const previewModeOptions: InputOption<string, PreviewMode>[] = [
  { label: 'HTML', value: 'html' },
  { label: 'TEXT', value: 'text' },
  { label: 'HTML Source', value: 'source' },
]

export const previewWidthOptions: InputOption<string, ScreenWidth>[] = [
  { label: 'Unset', value: 'none' },
  { label: 'Mobile', value: 'sm' },
  { label: 'Small mobile', value: 'xs' },
]

export const previewWidth: { [key in ScreenWidth]: number } = {
  none: 1200,
  sm: 414,
  xs: 320,
}
