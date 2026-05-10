package com.trixx1.stretchres.mixin;

import com.trixx1.stretchres.StretchConfig;
import net.minecraft.client.Mouse;
import org.spongepowered.asm.mixin.Mixin;
import org.spongepowered.asm.mixin.injection.At;
import org.spongepowered.asm.mixin.injection.Inject;
import org.spongepowered.asm.mixin.injection.callback.CallbackInfoReturnable;

@Mixin(Mouse.class)
public class MouseMixin {
    @Inject(method = "getX", at = @At("RETURN"), cancellable = true)
    private void onGetX(CallbackInfoReturnable<Double> cir) {
        if (StretchConfig.stretchFactor != 1.0) {
            cir.setReturnValue(cir.getReturnValueD() * StretchConfig.stretchFactor);
        }
    }
}
