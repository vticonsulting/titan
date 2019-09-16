<template>
    <figure
        class="chart-three animate"
        style="display: inline-block"
    >
        <svg
            role="img"
            xmlns="http://www.w3.org/2000/svg"
        >
            <title>[title here]</title>
            <desc>[long description here]</desc>
            <circle class="circle-background" />
            <circle class="circle-foreground" />
        </svg>
        <figcaption>75% of all males like donuts.</figcaption>
    </figure>
</template>

<script>
export default {
    name: 'RingChart',
    status: 'prototype',
    release: '1.0.0'
};
</script>

<style lang="scss" scoped>
@import '../../../sass/_variables.scss';

$configs: (
  chart-three: (
    svgSize: 96px,
    percentage: 75,
    strokeWidth: 8px,
    backgroundColor: $grey-lighter,
    foregroundColor: $secondary,
    labelColor: #4B4B4B,
    labelFontSize: 1.5rem,
    duration: 3s,
    animationDelay: 1s,
  ),
);

/* ------- DO NOT EDIT BELOW --------- */
$pi: 3.14;
$labelData: '';
@for $i from 0 to 101 {
$labelData: $labelData + $i + '%' + '\a';
}

@each $chart, $param in $configs {
  $c: (map-get($param, svgSize) - map-get($param, strokeWidth)) * $pi;
  $cOffSet: (map-get($param, percentage) / 100) * $c;

  .#{$chart} {
    width: map-get($param, svgSize);
    height: map-get($param, svgSize);
    margin: 0;
    position: relative;

    &.animate {
      svg .circle-foreground {
        animation: offset map-get($param, duration) ease-in-out forwards;
        animation-delay: map-get($param, animationDelay);
      }
      figcaption:after {
        animation: #{$chart}-label
          map-get($param, duration)
          steps(map-get($param, percentage))
          forwards;
        animation-delay: map-get($param, animationDelay);
      }
    }

    svg {
      width: 100%;
      height: 100%;
      .circle-background {
        r: (map-get($param, svgSize) - map-get($param, strokeWidth)) / 2;
        cx: 50%;
        cy: 50%;
        fill: none;
        stroke: map-get($param, backgroundColor);
        stroke-width: map-get($param, strokeWidth) * 0.4;
      }
      .circle-foreground {
        @extend .circle-background;
        stroke: map-get($param, foregroundColor);
        stroke-width: map-get($param, strokeWidth) * 0.7;
        stroke-dasharray: $cOffSet $c;
        stroke-dashoffset: $cOffSet;
        stroke-linecap: round;
        transform-origin: 50% 50%;
        transform: rotate(-90deg);
      }
    }
    figcaption {
      display: inline-block;
      width: 100%;
      height: map-get($param, labelFontSize);
      overflow: hidden;
      text-align: center;
      color: map-get($param, labelColor);
      position: absolute;
      top: calc(50% - #{map-get($param, labelFontSize) / 2});
      left: 0;
      font-size: 0;
      &:after {
        display: inline-block;
        content: $labelData;
        white-space: pre;
        font-size: map-get($param, labelFontSize);
        line-height: map-get($param, labelFontSize);
      }
    }
  }
  @keyframes #{$chart}-label {
    100% {
      transform: translateY(
        map-get($param, labelFontSize) * (-(map-get($param, percentage)))
      );
    }
  }
}
@keyframes offset {
  100% {
    stroke-dashoffset: 0;
  }
}
</style>
