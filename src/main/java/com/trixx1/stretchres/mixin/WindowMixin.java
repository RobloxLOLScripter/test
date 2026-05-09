package com.trixx1.stretchres.mixin;

import com.trixx1.stretchres.StretchConfig;
import net.minecraft.client.util.Window;
import org.spongepowered.asm.mixin.Mixin;
import org.spongepowered.asm.mixin.injection.At;
import org.spongepowered.asm.mixin.injection.Inject;
import org.spongepowered.asm.mixin.injection.callback.CallbackInfoReturnable;

@Mixin(Window.class)
public class WindowMixin {
    @Inject(method = "getScaleFactor", at = @At("RETURN"), cancellable = true)
    private void onGetScaleFactor(CallbackInfoReturnable<Double> cir) {
        if (StretchConfig.stretchFactor != 1.0) {
            cir.setReturnValue(cir.getReturnValueD() / StretchConfig.stretchFactor);
        }
    }
}
