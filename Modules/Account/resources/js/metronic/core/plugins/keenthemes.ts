import {
  MenuComponent,
  DrawerComponent,
  ScrollComponent,
  ScrollTopComponent,
  StickyComponent,
  ToggleComponent
} from "@/metronic/assets/ts/components";
import Theme from "@/metronic/assets/ts/_utils/_Theme";

/**
 * Initialize KeenThemes custom components
 */
Theme.init();
setTimeout(() => {
  ToggleComponent.bootstrap();
  ScrollComponent.bootstrap();
  ScrollTopComponent.bootstrap();
  DrawerComponent.bootstrap();
  StickyComponent.bootstrap();
  MenuComponent.bootstrap();
}, 1);
