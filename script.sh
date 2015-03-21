#!/usr/bin/env bash
sed -e 's/->/\\rightarrow/g' \
  -e 's/\./ \\wedge /g' \
  -e 's/\+/\\vee/g' \
  -e 's/!/\\neg/g' \
  -e 's/\[/\&\&\\text{/g' \
  -e 's/\]/} \\\\/g'
