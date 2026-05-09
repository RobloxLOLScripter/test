package com.trixx1.stretchres;

import net.fabricmc.api.ModInitializer;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

public class StretchRes implements ModInitializer {
    public static final String MOD_ID = "stretchres";
    public static final Logger LOGGER = LoggerFactory.getLogger(MOD_ID);

    @Override
    public void onInitialize() {
        LOGGER.info("StretchRes initialized!");
    }
}
